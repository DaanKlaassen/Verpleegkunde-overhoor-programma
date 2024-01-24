<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GildeDevOps Woord Spel</title>

    <link rel="stylesheet" href="source/css/betekenis_spel.css"> 

    <?php include "source/includes/snav.php"?>
    <link rel="stylesheet" href="source/css/nav.css"> 

</head>
<body>

<div class="main-menu"> 
    <!-- [Menu content] -->
</div>

<div class="mainbody">
    <a href="index.php"><ion-icon name="arrow-back-outline" class="back-button"></ion-icon></a>
    <?php
    include "source/includes/DBlogin.php";
    $selectedTable = $_GET["selected_table"] ?? '';
    session_start();

    if (!empty($selectedTable)) {
        if (!isset($_SESSION['sentences'])) {
            $result = $conn->query("SELECT * FROM $selectedTable");
            $sentences = [];
            while ($row = $result->fetch_assoc()) {
                $sentences[] = $row;
            }
            shuffle($sentences);
            $_SESSION['sentences'] = $sentences;
            $_SESSION['currentSentenceIndex'] = 0;
            $_SESSION['correctAnswers'] = 0;
            $_SESSION['wrongAnswers'] = 0;
            $_SESSION['wrongAnswersDetails'] = [];
            $_SESSION['answerSubmitted'] = false;
        }

        $totalSentences = count($_SESSION['sentences']);
        $currentSentenceIndex = $_SESSION['currentSentenceIndex'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['user_input'])) {
                $_SESSION['answerSubmitted'] = true;
                $currentSentence = $_SESSION['sentences'][$currentSentenceIndex];
                $correctWord = strtolower($currentSentence['woord']);
                $userInput = strtolower($_POST['user_input']);

                if ($userInput == $correctWord) {
                    $_SESSION['correctAnswers']++;
                    $feedback = "<p style='color: green;'>Correct!</p>";
                } else {
                    $_SESSION['wrongAnswers']++;
                    $_SESSION['wrongAnswersDetails'][$currentSentenceIndex] = $userInput;
                    $feedback = "<p style='color: red;'>Incorrect. The correct word was '$correctWord'.</p>";
                }
            }

            if (isset($_POST['next_word'])) {
                $_SESSION['currentSentenceIndex']++;
                $_SESSION['answerSubmitted'] = false;
            }
        } else {
            $feedback = "";
        }

        if ($_SESSION['currentSentenceIndex'] < $totalSentences) {
            $currentSentence = $_SESSION['sentences'][$currentSentenceIndex];
            $zinVoor = $currentSentence['zin_voor'];
            $zinAchter = $currentSentence['zin_achter'];

            if (!$_SESSION['answerSubmitted']) {
                echo "<form action='' method='post'>";
                echo "<p>$zinVoor <input type='text' name='user_input' required> $zinAchter</p>";
                echo "<input type='submit' value='Controleer antwoord'>";
                echo "</form>";
            } else {
                echo $feedback;
                echo "<form action='' method='post'>";
                echo "<input type='submit' name='next_word' value='Volgende woord'>";
                echo "</form>";
            }
            echo "<p>" . ($currentSentenceIndex + 1) . "/$totalSentences</p>";
        } else {
            echo "<p>Correct Answers: " . $_SESSION['correctAnswers'] . "</p>";
            echo "<p>Wrong Answers: " . $_SESSION['wrongAnswers'] . "</p>";
            session_destroy();
        }
    } else {
        echo "<p>Geen tabel geselecteerd.</p>";
    }
    ?>
</div>

</body>
</html>