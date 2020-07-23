SELECT Questionnaires.question_id
FROM Questionnaires t1
LEFT JOIN Responses t2 ON t2.question_id = t1.name
WHERE t2.question_id IS NULL