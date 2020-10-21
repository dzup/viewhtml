;dont allow direct link
if(!defined('APP_RAN')){ die(); }
; this is an INI file
; for viewhtml ver 0.0.1b
; by dzupd@yahoo.com
; Mon Nov 5 2012 11:50am
;
; DONT USE THIS FILE, insted:
; cp pastehtml.ini.example pastehtml.ini
; nano pastehtml.ini
; Since is overwrite when updating.

; define use old mysql definitions or no
; MYSQL=1
; PDO = 0
old_sql = 1

;viewhtml root, if blank $_SERVER["SERVER_NAME"] will be use, dont use trailing /
servername =

;main url, leave blank to use default, or change this, don't use trailing /
url = 

;warning notice to show users
warning_notice = "<small>WARNING! This is NOT the original website, DO NOT paste any REAL INFORMATION in here!</small>"

 
;if 1 add disqus, then change your credentials
disqus_active = 0
disqus_shortname = disgus_shortname

; if 1 then add google adsense, then you need to modify your adsense credentials
google_adsense = 0

;google adsense credentials
google_ad_client = ca-pub-xxxxxxxxxxxxxxxx
google_ad_slot = 1234567890
google_ad_width = 468
google_ad_height = 60

;database table name
mysql_database_table = pastehtml

;charset defaults to utf8 for latin
charset = utf8

; local or remote
; if you use local, the [local] values will be used
; same goes with 'remote', make no sense but if you are
;modifying the source and have different passwords in local-testing-site
;and production-site its better to change just this next variable
coneccion = local

[local]
mysql_host = localhost
mysql_database = viewhtml
mysql_user = viewhtml
mysql_password = viewhtml

[remote]
mysql_host = mysql.remote.tdl
mysql_database = remote_database
mysql_user = remote_user
mysql_password = remote_password
