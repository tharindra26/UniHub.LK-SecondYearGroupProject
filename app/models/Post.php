<?php
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addPostView($postId)
    {
        $this->db->query('INSERT INTO post_views (post_id) VALUES (:postId)');
        $this->db->bind(':postId', $postId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostsCount()
    {
        $this->db->query('SELECT COUNT(*) AS post_count FROM posts');
        $row = $this->db->single();
        return $row->post_count;
    }

    public function getAllPosts()
    {
        $this->db->query('SELECT 
                            *,
                            GROUP_CONCAT(pc.category_name) AS categories
                            FROM posts p
                            LEFT JOIN post_categories_mapping pcm ON p.post_id = pcm.post_id
                            LEFT JOIN post_categories pc ON pcm.category_id = pc.category_id
                            LEFT JOIN users u ON p.user_id = u.id
                            GROUP BY p.post_id');
        $results = $this->db->resultSet();
        return $results;
    }
    

    public function addPost($data)
    {
        // var_dump($data);
        // die();

        $this->db->query("INSERT INTO posts ( 
        user_id,
        post_title,
        post_description,
        post_profile_image, 
        post_cover_image, 
        material_link ) VALUES(:user_id, :post_title, :post_description, :post_profile_image, :post_cover_image, :material_link)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':post_title', $data['post_title']);
        $this->db->bind(':post_description', $data['post_description']);
        $this->db->bind(':post_profile_image', $data['post_profile_image']);
        $this->db->bind(':post_cover_image', $data['post_cover_image']);
        $this->db->bind(':material_link', $data['material_link']);



        // Begin the transaction
        $this->db->beginTransaction();

        // Execute the first query
        if (!$this->db->execute()) {
            // Rollback the transaction if there's an error
            $this->db->rollBack();
            return false;
        }

        // Get the last inserted event ID
        $postId = $this->db->lastInsertId();

        // Loop through each category ID and insert into the events_categories table
        foreach ($data['category_ids'] as $category_id) {
            // Insert into the event_categories table
            $this->db->query("INSERT INTO post_categories_mapping (post_id, category_id) VALUES (:post_id, :category_id)");

            // Bind values
            $this->db->bind(':post_id', $postId);
            $this->db->bind(':category_id', $category_id);

            // Execute the query
            if (!$this->db->execute()) {
                // Rollback the transaction if there's an error
                $this->db->rollBack();
                return false;
            }
        }

        if (isset($postId)) {
            // Process tags
            $tags = explode(',', $data['tags']);
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags); // Remove empty elements

            foreach ($tags as $tag) {

                // Insert into opportunity_tags pivot table
                $query = "INSERT INTO post_tags (post_id, tag_text) VALUES (:post_id, :tag_text)";
                $this->db->query($query);
                $this->db->bind(':post_id', $postId);
                $this->db->bind(':tag_text', $tag);
                if (!$this->db->execute()) {
                    // Failed to insert into opportunity_tags pivot table
                    return false;
                }
            }
        }


        // Commit the transaction if everything is successful
        $this->db->commit();
        return true;

    }

    public function getCategoryIdByName($categoryName)
    {
        $this->db->query('SELECT category_id FROM post_categories WHERE category_name = :name');

        $this->db->bind(':name', $categoryName);

        $row = $this->db->single();

        if ($row) {
            return $row->category_id;
        } else {
            return null; // or another default value depending on your logic
        }
    }

    public function searchPostsByKeyword($data)
    {
        $keyword = $data['keyword'];

        $query = 'SELECT 
            p.*,
            u.fname,
            u.lname,
            GROUP_CONCAT(DISTINCT pt.tag_text) AS tags,
            GROUP_CONCAT(DISTINCT pc.category_name) AS categories,
            GROUP_CONCAT(DISTINCT pl.user_id) AS liked_users,
            GROUP_CONCAT(DISTINCT pb.user_id) AS bookmarked_users,
            COUNT(DISTINCT pcmt.comment_id) AS comment_count
            FROM posts p
            LEFT JOIN post_tags pt ON p.post_id = pt.post_id
            LEFT JOIN post_categories_mapping pcm ON p.post_id = pcm.post_id
            LEFT JOIN post_categories pc ON pcm.category_id = pc.category_id
            LEFT JOIN users u ON p.user_id = u.id
            LEFT JOIN post_likes pl ON p.post_id = pl.post_id
            LEFT JOIN post_bookmarks pb ON p.post_id = pb.post_id
            LEFT JOIN post_comments pcmt ON p.post_id = pcmt.post_id
            WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND p.post_title LIKE :keyword";
        }

        // Group by post id to aggregate tags and categories
        $query .= " GROUP BY p.post_id";

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        // Execute the query
        $this->db->execute();

        // Fetch the results
        $posts = $this->db->resultSet();
        return $posts;
    }

    public function checkUserPostLike($data)
    {
        $this->db->query("SELECT * FROM post_likes WHERE user_id = :user_id AND post_id = :post_id");
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':post_id', $data['postId']);

        $this->db->single(); // Assuming you have a method like this to fetch a single row

        return $this->db->rowCount() > 0;
    }

    public function addUserPostLike($data)
    {
        $this->db->query("INSERT INTO post_likes (user_id, post_id) VALUES(:user_id, :post_id)");
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':post_id', $data['postId']);

        if ($this->db->execute()) {
            return true;
        }
    }

    public function deleteUserPostLike($data)
    {
        $this->db->query("DELETE FROM post_likes WHERE user_id = :user_id AND post_id = :post_id");
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':post_id', $data['postId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }




    public function checkUserPostBookmark($data)
    {
        $this->db->query("SELECT * FROM post_bookmarks WHERE user_id = :user_id AND post_id = :post_id");
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':post_id', $data['postId']);

        $this->db->single(); // Assuming you have a method like this to fetch a single row

        return $this->db->rowCount() > 0;
    }

    public function addUserPostBookmark($data)
    {
        $this->db->query("INSERT INTO post_bookmarks (user_id, post_id) VALUES(:user_id, :post_id)");
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':post_id', $data['postId']);

        if ($this->db->execute()) {
            return true;
        }
    }

    public function deleteUserPostBookmark($data)
    {
        $this->db->query("DELETE FROM post_bookmarks WHERE user_id = :user_id AND post_id = :post_id");
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':post_id', $data['postId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostById($postId)
    {
        // Prepare the SQL query to fetch the post by its ID
        $query = 'SELECT 
                p.*,
                u.fname,
                u.lname,
                u.profile_image AS user_profile_image,
                GROUP_CONCAT(DISTINCT pt.tag_text) AS tags,
                GROUP_CONCAT(DISTINCT pc.category_name) AS categories,
                GROUP_CONCAT(DISTINCT pl.user_id) AS liked_users,
                GROUP_CONCAT(DISTINCT pb.user_id) AS bookmarked_users,
                COUNT(DISTINCT pcmt.comment_id) AS comment_count
              FROM posts p
              LEFT JOIN post_tags pt ON p.post_id = pt.post_id
              LEFT JOIN post_categories_mapping pcm ON p.post_id = pcm.post_id
              LEFT JOIN post_categories pc ON pcm.category_id = pc.category_id
              LEFT JOIN users u ON p.user_id = u.id
              LEFT JOIN post_likes pl ON p.post_id = pl.post_id
              LEFT JOIN post_bookmarks pb ON p.post_id = pb.post_id
              LEFT JOIN post_comments pcmt ON p.post_id = pcmt.post_id
              WHERE p.post_id = :post_id';

        // Bind the post ID parameter
        $this->db->query($query);
        $this->db->bind(':post_id', $postId);

        // Execute the query
        $row = $this->db->single();

        // Check if there is a post with the given ID
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return null; // Post not found
        }
    }

    public function getCommentsByPostId($postId)
    {
        // Prepare the SQL query to fetch comments by post ID and join with the users table
        $query = 'SELECT 
                pc.*,
                u.profile_image AS user_profile_image,
                u.fname AS user_fname,
                u.lname AS user_lname
              FROM post_comments pc
              LEFT JOIN users u ON pc.user_id = u.id
              WHERE pc.post_id = :post_id';

        // Bind the post ID parameter
        $this->db->query($query);
        $this->db->bind(':post_id', $postId);

        // Execute the query
        $rows = $this->db->resultSet();

        // Check if there are comments for the given post ID
        if ($this->db->rowCount() > 0) {
            return $rows;
        } else {
            return []; // No comments found for the post
        }
    }

    public function addComment($data)
    {

        $query = 'INSERT INTO post_comments (user_id, post_id, comment_text) VALUES (:user_id, :post_id, :comment_text)';


        $this->db->query($query);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':comment_text', $data['comment_text']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCommentByCommentId($data)
    {
        $query = 'DELETE FROM post_comments WHERE comment_id = :comment_id';

        $this->db->query($query);
        $this->db->bind(':comment_id', $data['comment_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCommentByCommentid($data)
    {
        $query = 'UPDATE post_comments SET comment_text = :comment_text WHERE comment_id = :comment_id';

        $this->db->query($query);
        $this->db->bind(':comment_text', $data['comment_text']);
        $this->db->bind(':comment_id', $data['comment_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostCategories()
    {
        $this->db->query('SELECT * FROM post_categories');

        $rows = $this->db->resultSet();

        return $rows;
    }

    public function deletePostById($id)
    {
        // Construct the query to update the status field to 0
        $query = "UPDATE posts SET status = 0 WHERE post_id = :post_id";

        // Prepare the query
        $this->db->query($query);

        // Bind the post ID parameter
        $this->db->bind(':post_id', $id);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Post status updated successfully
        } else {
            return false; // Failed to update post status
        }
    }

    public function updatePost($data)
    {
        $this->db->query("UPDATE posts SET 
        post_title = :post_title,
        post_description = :post_description,
        post_profile_image = :post_profile_image, 
        post_cover_image = :post_cover_image, 
        material_link = :material_link 
        WHERE post_id = :post_id");

        //Bind values
        $this->db->bind(':post_title', $data['post_title']);
        $this->db->bind(':post_description', $data['post_description']);
        $this->db->bind(':post_profile_image', $data['post_profile_image']);
        $this->db->bind(':post_cover_image', $data['post_cover_image']);
        $this->db->bind(':material_link', $data['material_link']);
        $this->db->bind(':post_id', $data['post_id']);

        // Execute the query
        if (!$this->db->execute()) {
            return false;
        }

        // Delete existing categories for the post
        $this->db->query("DELETE FROM post_categories_mapping WHERE post_id = :post_id");
        $this->db->bind(':post_id', $data['post_id']);
        if (!$this->db->execute()) {
            return false;
        }

        // Insert updated categories for the post
        foreach ($data['category_ids'] as $category_id) {
            $this->db->query("INSERT INTO post_categories_mapping (post_id, category_id) VALUES (:post_id, :category_id)");
            $this->db->bind(':post_id', $data['post_id']);
            $this->db->bind(':category_id', $category_id);
            if (!$this->db->execute()) {
                return false;
            }
        }

        // Delete existing tags for the post
        $this->db->query("DELETE FROM post_tags WHERE post_id = :post_id");
        $this->db->bind(':post_id', $data['post_id']);
        if (!$this->db->execute()) {
            return false;
        }

        // Insert updated tags for the post
        $tags = explode(',', $data['tags']);
        $tags = array_map('trim', $tags);
        $tags = array_filter($tags); // Remove empty elements

        foreach ($tags as $tag) {
            $this->db->query("INSERT INTO post_tags (post_id, tag_text) VALUES (:post_id, :tag_text)");
            $this->db->bind(':post_id', $data['post_id']);
            $this->db->bind(':tag_text', $tag);
            if (!$this->db->execute()) {
                return false;
            }
        }

        return true;
    }

    public function getFilterPosts($data)
    {
        $keyword = $data['keyword'];
        $category = $data['category'];
        $status = $data['status'];
        $approval = $data['approval'];
        $startDate = $data['startDate']; // Assuming start_date and end_date are provided in $data
        $endDate = $data['endDate'];

        $query = 'SELECT 
                p.*,
                GROUP_CONCAT(c.category_name) AS category_names
                FROM posts p
                INNER JOIN users u ON p.user_id = u.id
                LEFT JOIN post_categories_mapping m ON p.post_id = m.post_id
                LEFT JOIN post_categories c ON m.category_id = c.category_id
                WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND p.post_title LIKE :keyword";
        }

        if (!empty($category)) {
            $query .= " AND c.category_id = :category";
        }

        if (!empty($status)) {
            $query .= " AND p.status = :status";
        }

        if (!empty($approval)) {
            $query .= " AND p.approval = :approval";
        }

        // Add date range conditions
        if (!empty($startDate) && !empty($endDate)) {
            $query .= " AND p.timestamp_column >= :start_date AND p.timestamp_column <= :end_date";
        } elseif (!empty($startDate)) {
            $query .= " AND p.timestamp_column >= :start_date";
        } elseif (!empty($endDate)) {
            $query .= " AND p.timestamp_column <= :end_date";
        }

        $query .= " GROUP BY p.post_id";

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        if (!empty($category)) {
            $this->db->bind(':category', $category);
        }

        if (!empty($approval)) {
            $this->db->bind(':approval', $approval);
        }

        if (!empty($status)) {
            if ($status == 'active')
                $this->db->bind(':status', 1);
            elseif ($status == 'deactivated') {
                $this->db->bind(':status', 0);
            }
        }

        // Bind date range values
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
        } elseif (!empty($startDate)) {
            $this->db->bind(':start_date', $startDate);
        } elseif (!empty($endDate)) {
            $this->db->bind(':end_date', $endDate);
        }

        // Execute the query
        $this->db->execute();

        // Fetch the results
        $row = $this->db->resultSet();
        return $row;
    }

    public function changeApproval($data){
        $this->db->query("UPDATE posts SET approval = :approval WHERE post_id = :post_id");
        $this->db->bind(':post_id', $data['postId']);
        $this->db->bind(':approval', $data['selectedPostApproval']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }



}