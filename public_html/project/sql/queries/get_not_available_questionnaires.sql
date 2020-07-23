SELECT * from Questionnaires as q where
(attempts_per_day < (SELECT COUNT(1)
FROM Responses where user_id = :uid and questionnaire_id = q.id and date(created) = CURDATE())