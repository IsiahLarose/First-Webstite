Begin;
INSERT INTO Questions (question)
  VALUES(:question);
INSERT INTO Answers (answer)
  VALUES(':question');
COMMIT;