CREATE TABLE IF NOT EXISTS comments (
                                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                                        postId INTEGER,
                                        author TEXT NOT NULL,
                                        content TEXT NOT NULL,
                                        createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
                                        FOREIGN KEY (postId) REFERENCES posts(id)
    );