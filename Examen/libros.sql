CREATE TABLE libros (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    genero VARCHAR(50),
    anio_publicacion INT,
    precio DECIMAL(5, 2),
    stock INT DEFAULT 0,
    editorial VARCHAR(100)
);
INSERT INTO libros (
        titulo,
        autor,
        genero,
        anio_publicacion,
        precio,
        stock,
        editorial
    )
VALUES (
        'Cien años de soledad',
        'Gabriel García Márquez',
        'Realismo Mágico',
        1967,
        19.99,
        10,
        'Sudamericana'
    ),
    (
        'Don Quijote de la Mancha',
        'Miguel de Cervantes',
        'Novela',
        1605,
        25.00,
        5,
        'Francisco de Robles'
    ),
    (
        '1984',
        'George Orwell',
        'Distopía',
        1949,
        15.99,
        20,
        'Secker & Warburg'
    ),
    (
        'Orgullo y prejuicio',
        'Jane Austen',
        'Romance',
        1813,
        9.99,
        12,
        'T. Egerton'
    ),
    (
        'La Odisea',
        'Homero',
        'Épica',
        -800,
        18.50,
        7,
        'Penguin Classics'
    ),
    (
        'Matar a un ruiseñor',
        'Harper Lee',
        'Drama',
        1960,
        12.99,
        8,
        'J.B. Lippincott & Co.'
    ),
    (
        'El gran Gatsby',
        'F. Scott Fitzgerald',
        'Novela',
        1925,
        10.99,
        15,
        'Charles Scribner\'s Sons'
    ),
    (
        'En busca del tiempo perdido',
        'Marcel Proust',
        'Filosofía',
        1913,
        22.99,
        4,
        'Grasset'
    ),
    (
        'Ulises',
        'James Joyce',
        'Modernismo',
        1922,
        23.50,
        6,
        'Shakespeare and Company'
    ),
    (
        'Hamlet',
        'William Shakespeare',
        'Tragedia',
        1603,
        8.50,
        14,
        'Norton'
    ),
    (
        'Crimen y castigo',
        'Fiódor Dostoyevski',
        'Psicológica',
        1866,
        14.99,
        9,
        'The Russian Messenger'
    ),
    (
        'Divina Comedia',
        'Dante Alighieri',
        'Poesía',
        1320,
        17.99,
        5,
        'Bompiani'
    ),
    (
        'Los miserables',
        'Victor Hugo',
        'Histórica',
        1862,
        20.00,
        10,
        'A. Lacroix'
    ),
    (
        'Fahrenheit 451',
        'Ray Bradbury',
        'Ciencia Ficción',
        1953,
        13.50,
        18,
        'Ballantine Books'
    ),
    (
        'La metamorfosis',
        'Franz Kafka',
        'Existencialismo',
        1915,
        11.99,
        16,
        'Kurt Wolff Verlag'
    );