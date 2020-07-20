SELECT
        ss.id as question_id,
        ss.id as question_id,
        ss.question as question,
       s.id as survey_id,
       s.name as survey_name,
       s.description as survey_description,
       a.id as answer_id,
       a.answer as answer,
       a.is_open_ended as open_ended
FROM `Questionnaires` as q
    JOIN Questions as ss on s.id = ss.survey_id
    JOIN Answers as a on a.question_id = ss.id where s.id = :survey_id