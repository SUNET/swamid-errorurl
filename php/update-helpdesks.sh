#!/bin/bash

get_helpdesks()
{
	url=$1

	cat <<EOF
<?php

\$helpdesks = array(
EOF

	last_entityid=""
	{
		curl -m 30 -s "$url" > metadata.tmp || return
		# shellcheck disable=SC2002
		cat metadata.tmp \
		| sed 's;\(</*\)[a-z0-9]*:;\1;g' \
		| sed 's/xmlns="[^"]*"//' \
		| xmllint --xpath "\
/EntitiesDescriptor/EntityDescriptor/@entityID|\
/EntitiesDescriptor/EntityDescriptor/IDPSSODescriptor/@errorURL|\
/EntitiesDescriptor/EntityDescriptor/IDPSSODescriptor/Extensions/UIInfo/DisplayName|\
/EntitiesDescriptor/EntityDescriptor/ContactPerson[@contactType='support']/EmailAddress" - 2>/dev/null \
		| sed -e 's; entityID=;\n&;g' -e 's;<DisplayName;\n&;g' -e 's;<EmailAddress;\n&;g' \
		| grep .
		echo ' entitytID=""'
	} | while read -r line ; do
		if echo "$line" | grep -q "entityID=" ; then
			if [ -n "$last_entityid" ] ; then
				echo "	'$last_entityid' => array("

				echo "		'displayname' => array("
				if [ -n "$displayname_sv" ] ; then
					if [ -n "$displayname_sv" ] ; then
						echo "			'sv' => '$displayname_sv',"
					fi
				fi
				if [ -n "$displayname_en" ] ; then
					if [ -n "$displayname_en" ] ; then
						echo "			'en' => '$displayname_en',"
					fi
				fi
				echo "		),"

				[ -n "$contactperson_email" ] && echo "		'contactperson_email' => '$contactperson_email',"
				[ -n "$errorurl" ] && echo "		'errorurl' => '$errorurl',"
				echo "	),"
			fi

			last_entityid=$(echo "$line" | sed -n 's;^ *entityID="\([^"]*\)".*;\1;p')
			displayname_sv=""
			displayname_en=""
			contactperson_email=""
			errorurl=""
		fi
		if echo "$line" | grep -q 'DisplayName.*lang="sv"' ; then
			displayname_sv=$(echo "$line" | sed -n 's;^<DisplayName xml:lang="sv">\([^<]*\)</DisplayName>;\1;p')
		fi
		if echo "$line" | grep -q 'DisplayName.*lang="en"' ;  then
			displayname_en=$(echo "$line" | sed -n 's;^<DisplayName xml:lang="en">\([^<]*\)</DisplayName>;\1;p')
		fi
		if echo "$line" | grep -q 'EmailAddress' ; then
			contactperson_email=$(echo "$line" | sed -n 's;^<EmailAddress>mailto:\([^<]*\)</EmailAddress>;\1;p')
		fi
		if echo "$line" | grep -q 'errorURL=' ; then
			errorurl=$(echo "$line" | sed -n 's;.*errorURL="\([^"]*\)".*;\1;p')
		fi
	done

	cat <<EOF
);

?>
EOF

	rm -f metadata.tmp
}

get_helpdesks https://mds.swamid.se/md/swamid-idp.xml > helpdesks.php.tmp || exit 1
# shellcheck disable=SC2002
if [ "$(cat helpdesks.php.tmp | wc -l)" -lt 20 ] ; then
	echo "helpdesks.php.tmp too small"
	rm -f helpdesks.php.tmp
	exit 1
fi

diff -U 10 helpdesks.php helpdesks.php.tmp
mv helpdesks.php.tmp helpdesks.php

