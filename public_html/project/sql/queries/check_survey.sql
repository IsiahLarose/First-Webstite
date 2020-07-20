SELECT
    count(IF(date(r.created) = curdate(),true, null)) as responses_today,
    s.use_max,
    count(r.created) as responses_total,
    s.max_attempts,
    s.attempts_per_day
FROM
    (SELECT id, use_max, max_attempts, attempts_per_day FROM Survey WHERE id = :qid ) as q
        left join
    (SELECT survey_id, created FROM Responses where user_id = :uid group by survey_id) as r

    on s.id = r.survey_id