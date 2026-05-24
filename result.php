$nomParticipant =
                isset($membres[$idParticipant])
                ? $membres[$idParticipant]
                : $idParticipant;

            $complexite = (float)$p->complexite;
            $temps = (float)$p->tempsExecution;
            $coefficient = (float)$c['coefficient'];

            $score =
                calculScore(
                    $complexite,
                    $temps,
                    $coefficient
                );

            $participants[] = [

                "nom" => $nomParticipant,
                "complexite" => $complexite,
                "temps" => $temps,
                "score" => $score

            ];
        }


        usort($participants, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        $rang = 1;

        foreach ($participants as $p) {

            $class = ($rang == 1) ? "winner" : "";

            echo "<tr class='$class'>";

            echo "<td>".$rang."</td>";
            echo "<td>".$p['nom']."</td>";
            echo "<td>".$p['complexite']."</td>";
            echo "<td>".$p['temps']."</td>";
            echo "<td>".$p['score']."</td>";

            echo "</tr>";

            $rang++;
        }

?>

        </table>

    </div>

<?php
}
?>

</div>

</body>
</html>
