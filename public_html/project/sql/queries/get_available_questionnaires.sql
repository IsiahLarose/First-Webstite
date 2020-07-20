SELECT * from Survey as s where
(attempts_per_day > (SELECT COUNT(1)
FROM Responses where user_id = :uid and survey_id = q.id and date(created) = CURDATE())
and
s.use_max = 0)
or
(s.use_max = 1 and s.max_attempts > (select COUNT(1) from Responses where user_id = :uid and survey_id = s.id))