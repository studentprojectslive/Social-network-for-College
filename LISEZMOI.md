HTML2PDF v4.5.1 - 2016-03-03
============================

License:
--------
```
 Ce programme est distribué sous la licence LGPL,
 Pour plus dinformations, reportez-vous au fichier _LGPL.txt ou à
 http://www.gnu.org/licenses/lgpl.html
 
 Copyright 2008-2016 par Laurent Minguet
```

Utilisation :
------------

 * nécessite au minimum PHP 5.3.2

 * Utilisez composer pour linstaller
   * Composer : https://getcomposer.org/
   * Package officiel : spipu/html2pdf
        
 * Si vous installez html2pdf sans utiliser composer, cela ne marchera pas.
   Vous devez faire "composer install" dans le répertoire dhtml2pdf
   afin dinstaller TCPDF en tant que dépendance.
   
 * regardez les exemples fournis, et lisez le wiki pour comprendre le fonctionnement.

 * il est TRES IMPORTANT de fournir du HTML 4.01 valide au convertisseur,
 mais seulement ce que contient le `<body>`. Utilisez la balise `<page>`.

 * pour les borders : il est conseillé quils soient au format `solid 1mm #000000`

 * pour les paddings : ils ne sont applicables quaux balises table, th, td, div, li

 * Une fonte par défaut peut être précisée,au cas ou la fonte demandée nexiste pas ou si aucune fonte nest indiquée :
 
 `$html2pdf->setDefaultFont(Arial);`

 * la possibilité de protéger vos PDF est présente, CF Exemple 7.

 * Certains tests peuvent être activés (true) ou de désactivés(false) :
 
  * méthode setTestIsImage      : tester que les images existent bien
  
  * méthode setTestTdInOnePage  : tester que le contenu des TDs rentre sur une seule page
  
  * méthode setTestIsDeprecated : tester que les anciennes propriétes des balises spécifiques ne sont plus présentes

 * Un mode DEBUG permettant de connaitre les ressources utilisées lors de la construction du PDF est présent.
Il est activable en rajoutant la commande suivante juste après le constructeur (cf exemple 0):
`$htmlpdf->setModeDebug();`

 * Certaines balises spécifiques ont été introduites :
  
  * <page></page>  (CF Exemple 7 & wiki)
    * permet de définir le format, lorientation, les marges left, right, top et bottom, limage
    * et la couleur de fond dune page, sa taille et position, le footer.
    * Il est également possible de garder les header et footer des pages précédentes,
    * grâce à lattribue pageset="old" (CF Exemple 3 & 4 & wiki)
 
  * <page_header></page_header> (CF Exemple 3 & wiki)

  * <page_footer></page_footer> (CF Exemple 3 & wiki)

  * <nobreak></nobreak> (cf wiki)
    * permet de forcer laffichage dune partie sur une même page.
    * Si cette partie ne rentre pas dans le reste de la page, un saut de page est effectué avant.
 
  * <barcode></barcode>  (CF Exemples 0 et 9 & wiki)
    * permet dinsérer des barcodes dans les pdfs, CF Exemples 0 et 9
    * Les types de codebar possible sont ceux de TCPDF
         
  * <qrcode></qrcode> (CF Exemple 13 & wiki)
    * permet dinsérer un codebar à 2 dimensions de type QRcode
    * (QR Code is registered trademark of DENSO WAVE INCORPORATED | http://www.denso-wave.com/qrcode/)

  * <bookmark></bookmark>  (CF Exemples 7 & About & wiki)
    * permet dinsérer des bookmarks dans les pdfs, CF Exemple 7 et About.
    * Il est également possible de créer un index automatiquement en fin de document (cf wiki)

  * propriété css "rotate" :
    * valeurs possibles : 0, 90, 180, 270
    * applicable uniquement sur les divs (cf exemple 8)

change log :
------------

Regardez le fichier _changelog.txt

Aide et Support :
-----------------

 pour toutes questions et rapport de bug, merci dutiliser exclusivement le lien de support ci-dessous.
 Je ne répondrai à aucune question en dehors, afin que tout le monde puisse profiter des réponses.

Informations :
-------------

* Programmeur : Spipu
* Web Site    : http://html2pdf.fr/
* Wiki        : http://html2pdf.fr/fr/wiki
* Support     : http://html2pdf.fr/fr/forum

Remerciement :
--------------

 * Olivier Plathey pour avoir conçu FPDF
 * Nicola Asuni pour les modifications quil a accepté dapporter à TCPDF
 * yAronet pour lhébergement du forum de support
 * toutes les personnes qui mont aidé à développer cette librairie, et à traduire les différents textes
