xquery version "3.1";

let $doc := doc("club.xml")

return (

(: 1. Ajouter une nouvelle catégorie :)
insert node
<categorie id="C4" libelle="Machine Learning"/>
into $doc//categories,

(: 2. Modifier un email :)
replace value of node
$doc//membre[@id="M002"]/email
with "lina.amrani@updated.dz",

(: 3. Supprimer un participant dupliqué :)
delete node
$doc//concours[@id="CO3"]/participants/participant[@membreRef="M007"][2],

(: 4. Modifier coefficient d’un concours :)
replace value of node
$doc//concours[@id="CO2"]/@coefficient
with "1.4",

(: 5. Ajouter un membre :)
insert node
<membre id="M009" categorieRef="C1">
  <nom>Test</nom>
  <prenom>User</prenom>
  <email>test@club.dz</email>
</membre>
into $doc//membres

)
