DELETE FROM users;
DELETE FROM tasks;
DELETE FROM administrators;
DELETE FROM submits;
DELETE FROM bids;
DELETE FROM allocated;

INSERT INTO users (username, user_id, password) VALUES ('Kiran94', '000001', 'kiran9494');
INSERT INTO users (username, user_id, password) VALUES ('Lenny24', '000002', 'Len2445');
INSERT INTO users (username, user_id, password) VALUES ('Bond007', '000003', 'doubleoseven');
INSERT INTO users (username, user_id, password) VALUES ('James20', '000004', 'jamesbond');
INSERT INTO users (username, user_id, password) VALUES ('Julian33', '000005', 'Jackqueenking');
INSERT INTO users (username, user_id, password) VALUES ('Ace01', '000006', 'spades45');
INSERT INTO users (username, user_id, password) VALUES ('Animallover96', '000007', 'Shibainu22');
INSERT INTO users (username, user_id, password) VALUES ('Vegeta22', '000008', 'Dragonball555');
INSERT INTO users (username, user_id, password) VALUES ('Awesomeness55', '000009', 'ismemario26');
INSERT INTO users (username, user_id, password) VALUES ('NemoFinder65', '000010', 'psherman42');
INSERT INTO users (username, user_id, password) VALUES ('Triangle44', '000011', 'square55');
INSERT INTO users (username, user_id, password) VALUES ('Christian54', '000012', 'balexoxo');
INSERT INTO users (username, user_id, password) VALUES ('Jesus78', '000013', 'lordnsavior');
INSERT INTO users (username, user_id, password) VALUES ('Dynamo78', '000014', 'iamacat27');
INSERT INTO users (username, user_id, password) VALUES ('Chickeneater79', '000015', 'kfcisgood900');
INSERT INTO users (username, user_id, password) VALUES ('Loverboy69', '000016', 'lonelyboy96');
INSERT INTO users (username, user_id, password) VALUES ('Link22', '000017', 'zeldalover34');
INSERT INTO users (username, user_id, password) VALUES ('Zelda97', '000018', 'linkisnotmytype34');

INSERT INTO tasks VALUES ('0000001', 'clean my car - Honda Civic SHA1456P', 'Bukit Timah', CURRENT_DATE + 2, '13:00:00');
INSERT INTO tasks VALUES ('0000002', 'clean my kitchen stove - Chemical cleaning', 'Bukit Merah', CURRENT_DATE + 4, '14:00:00');
INSERT INTO tasks VALUES ('0000003', 'Pipe repair - Professional needed', 'Tampines', CURRENT_DATE + 5, '13:00:00');
INSERT INTO tasks VALUES ('0000004', 'Babysit - 4 year old and 3 year old', 'Bukit Timah', CURRENT_DATE + 7, '12:00:00');
INSERT INTO tasks VALUES ('0000005', 'Household chores', 'Redhill', CURRENT_DATE + 8, '13:00:00');
INSERT INTO tasks VALUES ('0000006', 'Package Delivery - To Pasir Panjang', 'Jurong East', CURRENT_DATE + 3, '12:00:00');
INSERT INTO tasks VALUES ('0000007', 'Restock office supplies', 'Bukit Panjang', CURRENT_DATE + 6, '13:00:00');
INSERT INTO tasks VALUES ('0000008', 'Gardening', 'Bukit Timah', CURRENT_DATE + 1, '13:00:00');

INSERT INTO administrators VALUES ('01', 'CHAT_REGULATOR', 'admin11235');
INSERT INTO administrators VALUES ('02', 'TASK_REGULATOR', 'admin12358');
INSERT INTO administrators VALUES ('03', 'BID_REGULATOR', 'admin35813');
INSERT INTO administrators VALUES ('04', 'ALLOC_REGULATOR', 'admin81321');

INSERT INTO submits VALUES ('000004', '0000001');
INSERT INTO submits VALUES ('000003', '0000002');
INSERT INTO submits VALUES ('000006', '0000003');
INSERT INTO submits VALUES ('000011', '0000004');
INSERT INTO submits VALUES ('000001', '0000005');
INSERT INTO submits VALUES ('000012', '0000006');
INSERT INTO submits VALUES ('000018', '0000007');
INSERT INTO submits VALUES ('000005', '0000008');

INSERT INTO bids VALUES ('50', '000015', '0000002', '000003');
INSERT INTO bids VALUES ('100', '000016', '0000002', '000003');
INSERT INTO bids VALUES ('20', '000013', '0000004', '000011');
INSERT INTO bids VALUES ('200', '000002', '0000004', '000011');
INSERT INTO bids VALUES ('10', '000009', '0000001', '000004');
INSERT INTO bids VALUES ('50', '000013', '0000003', '000006');
INSERT INTO bids VALUES ('50', '000014', '0000005', '000001');
INSERT INTO bids VALUES ('200', '000017', '0000007', '000018');
INSERT INTO bids VALUES ('50', '000007', '0000007', '000018');
INSERT INTO bids VALUES ('50', '000008', '0000006', '000012');
INSERT INTO bids VALUES ('50', '000010', '0000008', '000005');

INSERT INTO allocated VALUES ('000009', '0000001', '000004');
INSERT INTO allocated VALUES ('000016', '0000002', '000003');
INSERT INTO allocated VALUES ('000013', '0000003', '000006');
INSERT INTO allocated VALUES ('000002', '0000004', '000011');
INSERT INTO allocated VALUES ('000014', '0000005', '000001');
INSERT INTO allocated VALUES ('000008', '0000006', '000012');
INSERT INTO allocated VALUES ('000017', '0000007', '000018');
INSERT INTO allocated VALUES ('000010', '0000008', '000005');






