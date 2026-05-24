xquery version "3.1";

let $doc := doc("club.xml")

return
<resultats>

{
  for $m in $doc//membre
  let $cat := $doc//categorie[@id = $m/@categorieRef]
  return
    <membre>
      <id>{data($m/@id)}</id>
      <nomComplet>{concat($m/prenom, " ", $m/nom)}</nomComplet>
      <email>{data($m/email)}</email>
      <categorie>{data($cat/@libelle)}</categorie>
    </membre>
}

{
  for $c in $doc//concours/concours
  return
    <concours>
      <titre>{data($c/titre)}</titre>
      <date>{data($c/@date)}</date>
      <coefficient>{data($c/@coefficient)}</coefficient>
    </concours>
}

{
  for $c in $doc//concours/concours
  let $coef := xs:decimal($c/@coefficient)
  for $p in $c/participants/participant
  let $score := (xs:integer($p/complexite) + xs:integer($p/tempsExecution)) * $coef
  return
    <resultat>
      <concours>{data($c/titre)}</concours>
      <membre>{data($p/@membreRef)}</membre>
      <score>{round($score,2)}</score>
    </resultat>
}

{
  for $c in $doc//concours/concours
  let $coef := xs:decimal($c/@coefficient)
  let $scores :=
    for $p in $c/participants/participant
    let $score := (xs:integer($p/complexite) + xs:integer($p/tempsExecution)) * $coef
    return <tmp><membre>{data($p/@membreRef)}</membre><score>{$score}</score></tmp>

  let $max := max($scores/score/xs:decimal(.))

  for $s in $scores[xs:decimal(score) = $max]
  return
    <vainqueur>
      <concours>{data($c/titre)}</concours>
      <membre>{data($s/membre)}</membre>
      <score>{round(xs:decimal($s/score),2)}</score>
    </vainqueur>
}

{
  for $m in $doc//membre
  let $cat := $doc//categorie[@id = $m/@categorieRef]
  where $cat/@libelle = "Intelligence Artificielle"
  order by $m/nom
  return
    <membre>
      <id>{data($m/@id)}</id>
      <nomComplet>{concat($m/prenom, " ", $m/nom)}</nomComplet>
      <email>{data($m/email)}</email>
    </membre>
}

</resultats>
