Begin;
INSERT INTO Questions (question)
  VALUES(:question);
INSERT INTO Answers (answer)
  VALUES(LAST_INSERT_ID()':question');
COMMIT;