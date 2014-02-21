To remove the generated error 401 Authorization Required page.
Go to:
1) Search path: /etc/zpanel/panel
2) Delete 401.html
3) Modify .htaccess
Remove the line below:

######################################################
# CUSTOM .htaccess INSTERTED BELOW TO BLOCK BAD BOTS #
# 		  YOU CAN DELETE THIS LINE BELOW             #
######################################################
RewriteEngine On
RewriteBase /
 
# IF THE UA STARTS WITH THESE
RewriteCond %{HTTP_USER_AGENT} ^(aesop_com_spiderman|alexibot|backweb|bandit|batchftp|bigfoot) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(black.?hole|blackwidow|blowfish|botalot|buddy|builtbottough|bullseye) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(cheesebot|cherrypicker|chinaclaw|collector|copier|copyrightcheck) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(cosmos|crescent|curl|custo|da|diibot|disco|dittospyder|dragonfly) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(drip|easydl|ebingbong|ecatch|eirgrabber|emailcollector|emailsiphon) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(emailwolf|erocrawler|exabot|eyenetie|filehound|flashget|flunky) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(frontpage|getright|getweb|go.?zilla|go-ahead-got-it|gotit|grabnet) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(grafula|harvest|hloader|hmview|httplib|httrack|humanlinks|ilsebot) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(infonavirobot|infotekies|intelliseek|interget|iria|jennybot|jetcar) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(joc|justview|jyxobot|kenjin|keyword|larbin|leechftp|lexibot|lftp|libweb) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(likse|linkscan|linkwalker|lnspiderguy|lwp|magnet|mag-net|markwatch) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(mata.?hari|memo|microsoft.?url|midown.?tool|miixpc|mirror|missigua) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(mister.?pix|moget|mozilla.?newt|nameprotect|navroad|backdoorbot|nearsite) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(net.?vampire|netants|netcraft|netmechanic|netspider|nextgensearchbot) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(attach|nicerspro|nimblecrawler|npbot|octopus|offline.?explorer) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(offline.?navigator|openfind|outfoxbot|pagegrabber|papa|pavuk) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(pcbrowser|php.?version.?tracker|pockey|propowerbot|prowebwalker) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(psbot|pump|queryn|recorder|realdownload|reaper|reget|true_robot) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(repomonkey|rma|internetseer|sitesnagger|siphon|slysearch|smartdownload) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(snake|snapbot|snoopy|sogou|spacebison|spankbot|spanner|sqworm|superbot) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(superhttp|surfbot|asterias|suzuran|szukacz|takeout|teleport) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(telesoft|the.?intraformant|thenomad|tighttwatbot|titan|urldispatcher) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(turingos|turnitinbot|urly.?warning|vacuum|vci|voideye|whacker) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} ^(libwww-perl|widow|wisenutbot|wwwoffle|xaldon|xenu|zeus|zyborg|anonymouse) [NC,OR]
 
# STARTS WITH WEB
RewriteCond %{HTTP_USER_AGENT} ^web(zip|emaile|enhancer|fetch|go.?is|auto|bandit|clip|copier|master|reaper|sauger|site.?quester|whack) [NC,OR]
 
# ANYWHERE IN UA -- GREEDY REGEX
RewriteCond %{HTTP_USER_AGENT} ^.*(craftbot|download|extract|stripper|sucker|ninja|clshttp|webspider|leacher|collector|grabber|webpictures).*$ [NC]

##########################################################
# CUSTOM .htaccess INSTERTED ERROR PAGE 401 Unauthorized #
# 		     YOU CAN DELETE THIS LINE BELOW              #
########################################################## 
# ISSUE 403 / SERVE ERRORDOCUMENT
RewriteRule . - [F,L]

ErrorDocument 401 /401.html


Added directives to the ZPanel .htaccess explanation:
The added line BLOCK BAD BOTS is to block bad crawlers called BAD BOTS. As I have noticed that your main ZPanel login page can be crawled by this BOTS. If you want to leave the settings, this will not affect your ZPanel.. this will just block those BAD BOTS.

IMPORTANT:
DO NOT delete the first line:
#####################################################
# ORIGINAL ZPANEL .htaccess DO NOT DELETE THIS LINE #
#####################################################
RewriteEngine on
RewriteRule ^api/([^/\.]+)/?$ bin/api.php?m=$1 [L]
RewriteRule ^apps/([^/\.]+)/?$ etc/apps/$1 [L]
#####################################################
This is used by ZPanel by default.


-------------------------END READ ME TEXT-------------------------
