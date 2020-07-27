SELECT
    question_id, user_id, COUNT(*)
FROM
    Responses
GROUP BY
    question_id, user_id
HAVING
    COUNT(*) > 1