<?php

$questions = [
    [
        'question' => 'Which planet is known as the Red Planet?',
        'options' => ['Earth', 'Mars', 'Jupiter', 'Saturn'],
        'answer' => '2'
    ],
    [
        'question' => 'What is 2+2?',
        'options' => ['1', '2', '3', '4'],
        'answer' => '4'
    ],
    [
        'question' => 'What is the largest ocean on Earth?',
        'options' => ['Atlantic Ocean', 'Indian Ocean', 'Arctic Ocean', 'Pacific Ocean'],
        'answer' => '4'
    ],
    [
        'question' => 'What is the population of BD?',
        'options' => ['5 million', '1 million', '180 million', '9 million'],
        'answer' => '3'
    ],
    [
        'question' => 'What is the chemical symbol for water?',
        'options' => ['O2', 'H2O', 'CO2', 'NaCl'],
        'answer' => '2'
    ]
    ];

$answers = [];

function evaluateQuiz(array $questions, array $answers): int
{
    $score = 0;
    foreach ($questions as $index => $question) {
        if (isset($answers[$index]) && $answers[$index] === $question['answer']) {
            $score++;
        }
    }
    return $score;
}

foreach ($questions as $index => $question) {
    echo ($index + 1) . ". " . $question['question'] . "\n";
    for ($i = 0; $i < count($question['options']); $i++) {
        echo " " . ($i + 1) . ") " . $question['options'][$i] . "\n";
    }
    $answers[] = trim(readline("Your answer(1,2,3,4) : "));
}

$score = evaluateQuiz($questions, $answers);
echo "Your score: $score out of " . count($questions) . "\n";

if ($score === count($questions)) {
    echo "Excellent! You got all answers correct.\n";
} elseif ($score === 4) {
    echo "Great job!\n";
} elseif ($score >= 1 && $score <= 3) {
    echo "Good job! You passed the quiz.\n";
} elseif ($score === 0){
    echo "Better luck next time. Keep practicing!\n";
}



