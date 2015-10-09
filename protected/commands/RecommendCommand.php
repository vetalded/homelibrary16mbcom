SELECT user_id, `book_id` as id(ids)
FROM `book_rate`
WHERE `user_id`
IN (

SELECT `user_id`
FROM `book_rate`
WHERE `rate` >80
AND `book_id`
IN (

SELECT `book_id`
FROM `book_rate`
WHERE `user_id`
IN (

SELECT `id` AS user_id
FROM `user`
)
AND `rate` >80
)
)
ORDER BY  user_id,`book_id`
IN ( 17, 1 ) DESC