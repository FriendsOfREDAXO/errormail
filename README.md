# errormail

errormail versendet einen Auszug des system.log, wenn es Exceptions, Errors und eigene logevents findet. 
Der Check und ggf. Zusendung erfolgt mindestens im 15 oder 30 Minuten-Abstand um Massenmailings zu verhindern. Empfänger ist die im System hinterlegte Fehleradresse. 

Eigene Events können den Versand ebenso auslösen dazu sollte man im Log den Event als Typ: logevent ablegen. 
`rex_logger::factory()->log('logevent', 'Mein Text zum Event');`

### Installation
- Benötigt konfigurierten PHPMAiler
- Installation erfolgt über den Installer
- Die Konfiguration findet man in den Systemeinstellungen

### Bugtracker

Du hast einen Fehler gefunden oder ein nettes Feature parat? [Lege ein Issue an](https://github.com/FriendsOfREDAXO/errormail/issues). Bevor du ein neues Issue erstellst, suche bitte ob bereits eines mit deinem Anliegen existiert und lese die [Issue Guidelines (englisch)](https://github.com/necolas/issue-guidelines) von [Nicolas Gallagher](https://github.com/necolas/).

### Changelog

siehe [CHANGELOG.md](https://github.com/FriendsOfREDAXO/errormail/blob/master/CHANGELOG.md)

### Lizenz

siehe [LICENSE](https://github.com/FriendsOfREDAXO/errormail/blob/master/LICENSE)


### Autor

**Friends Of REDAXO**

* http://www.redaxo.org
* https://github.com/FriendsOfREDAXO

**Projekt-Lead**

[Thomas Skerbis](https://github.com/skerbis)

**Credits**

Danke an: 

**First Release**

[Thomas Kägi](https://github.com/phoebusryan)

