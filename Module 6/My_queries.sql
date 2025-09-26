-- 1) Display all columns and all rows from the posts table
SELECT * FROM posts;


-- 2) Show the post titles along with the corresponding author’s name
SELECT posts.title, users.name as Author
FROM posts
INNER JOIN users ON posts.author_id = users.id;


-- 3) Insert a new row into the posts table with the "My new value for user 2" values for author_id = 2
INSERT INTO posts (title, slug, body, author_id) 
VALUES ('My new value for user 2', 'my-new-value-for-user-2', 'new post', 2);


-- 4) Change the title of the post with id = 1 to 'Updated First Post'
UPDATE posts 
SET title = 'Updated First Post' 
WHERE id = 1;


-- 5) Find the number of posts written by each author
SELECT users.name, COUNT(posts.id) AS num_of_posts
FROM users
LEFT JOIN posts ON users.id = posts.author_id
GROUP BY users.id, users.name;


-- 6) Display the newest posts first
SELECT * FROM posts 
ORDER BY created_at DESC;


-- 7) Display the newest two (02) posts
SELECT * FROM posts 
ORDER BY created_at DESC 
LIMIT 2;


-- 8) Show only those posts that have comments
SELECT posts.title, comments.body AS comments
FROM posts
RIGHT JOIN comments ON posts.id = comments.post_id;


-- 9) Display multiple tags of a single post as comma-separated values
SELECT posts.title, GROUP_CONCAT(tags.name) AS tags
FROM posts
INNER JOIN post_tag ON posts.id = post_tag.post_id
INNER JOIN tags ON post_tag.tag_id = tags.id
GROUP BY posts.id, posts.title;
