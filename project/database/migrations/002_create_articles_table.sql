CREATE TABLE IF NOT EXISTS articles
(
    id
    INT
    UNSIGNED
    AUTO_INCREMENT
    PRIMARY
    KEY,
    image
    VARCHAR
(
    255
) NULL,
    title VARCHAR
(
    255
) NOT NULL,
    description TEXT NULL,
    content LONGTEXT NOT NULL,
    views INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );