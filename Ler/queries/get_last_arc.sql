SELECT last_arc_id from History where user_id = :user_id and story_id = :story_id ORDER BY created DESC LIMIT 1