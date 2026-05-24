xquery version "3.1";

(: Charger le document XML :)
let $doc := doc("club.xml")

return
<resultats>

{
  (: Parcourir tous les membres :)
  for $m in $doc//membre
  
  (: Récupérer la catégorie du membre :)
  let $cat := $doc//categorie[@id = $m/@categorieRef]
  
  (: Retourner les informations du membre :)
  return
    <membre>
      <id>{data($m/@id)}</id>
      <nomComplet>{concat($m/prenom, " ", $m/nom)}</nomComplet>
      <email>{data($m/email)}</email>
      <categorie>{data($cat/@libelle)}</categorie>
    </membre>
}

{
  (: Parcourir tous les concours :)
  for $c in $doc//concours/concours
  
  (: Afficher les informations du concours :)
  return
    <concours>
      <titre>{data($c/titre)}</titre>
      <date>{data($c/@date)}</date>
      <coefficient>{data($c/@coefficient)}</coefficient>
    </concours>
}

{
  (: Parcourir les concours :)
  for $c in $doc//concours/concours
  
  (: Récupérer le coefficient du concours :)
  let $coef := xs:decimal($c/@coefficient)
  
  (: Parcourir les participants :)
  for $p in $c/participants/participant
  
  (: Calculer le score du participant :)
  let $score := (xs:integer($p/complexite) + xs:integer($p/tempsExecution)) * $coef
  
  (: Afficher les résultats :)
  return
    <resultat>
      <concours>{data($c/titre)}</concours>
      <membre>{data($p/@membreRef)}</membre>
      <score>{round($score,2)}</score>
    </resultat>
}

{
  (: Parcourir les concours :)
  for $c in $doc//concours/concours
  
  (: Récupérer le coefficient :)
  let $coef := xs:decimal($c/@coefficient)
  
  (: Calculer les scores des participants :)
  let $scores :=
    for $p in $c/participants/participant
    let $score := (xs:integer($p/complexite) + xs:integer($p/tempsExecution)) * $coef
    return 
      <tmp>
        <membre>{data($p/@membreRef)}</membre>
        <score>{$score}</score>
      </tmp>

  (: Trouver le score maximum :)
  let $max := max($scores/score/xs:decimal(.))

  (: Sélectionner le ou les vainqueurs :)
  for $s in $scores[xs:decimal(score) = $max]
  
  (: Retourner le vainqueur :)
  return
    <vainqueur>
      <concours>{data($c/titre)}</concours>
      <membre>{data($s/membre)}</membre>
      <score>{round(xs:decimal($s/score),2)}</score>
    </vainqueur>
}

{
  (: Parcourir les membres :)
  for $m in $doc//membre
  
  (: Récupérer la catégorie du membre :)
  let $cat := $doc//categorie[@id = $m/@categorieRef]
  
  (: Filtrer les membres de la catégorie Intelligence Artificielle :)
  where $cat/@libelle = "Intelligence Artificielle"
  
  (: Trier les membres par nom :)
  order by $m/nom
  
  (: Afficher les membres filtrés :)
  return
    <membre>
      <id>{data($m/@id)}</id>
      <nomComplet>{concat($m/prenom, " ", $m/nom)}</nomComplet>
      <email>{data($m/email)}</email>
    </membre>
}

</resultats>
