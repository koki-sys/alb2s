/* 既に予約しているときの処理 */

INSERT INTO pay
VALUES
  (0, "現金"),
  (1, "クレジットカード");

INSERT INTO customer
VALUES
  (1, "user1", "sample1@example.com", "password1");

INSERT INTO credit_card
VALUES
  ("1111111111111111", 1, "2020-11-01");

INSERT INTO trader
VALUES
  (1, "業者1", "trader1@example.com", "pass1");

INSERT INTO box_lunch
VALUES
  (1, 1, "デラックス", 350, 20, "menu4.jpg"),
  (2, 1, "かつ丼", 400, 30, "menu1.jpg"),
  (3, 1, "唐揚げ弁当", 420, 25, "menu3.jpg"),
  (4, 1, "生姜焼き弁当", 350, 20, "menu5.jpg");

INSERT INTO reservation
VALUES
  (1, 1, 1, "2", "2020-09-11", 0, 1, "1111111111111111"),
  (2, 1, 2, "1", "2020-11-11", 0, 1, "1111111111111111");
