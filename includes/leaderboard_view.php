<?php

function showLeaderboard($lb, int $ranking) {
    foreach ($lb as $row) {
        $score = number_format($row[2]);
        echo "<tr>
                <th scope='row'>{$ranking}</th>
                <td>{$row[0]}</td>
                <td>{$row[1]}</td>
                <td>{$score}</td>
              </tr>";
        $ranking++;
    }
}