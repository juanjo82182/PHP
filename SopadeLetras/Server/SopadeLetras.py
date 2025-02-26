import random
import string
import nltk
import threading


nltk.download("cess_esp")  # Descargar el corpus en español

from nltk.corpus import cess_esp
import random
import unicodedata

# Obtener las palabras del corpus en español
words = cess_esp.words()

valid_words = [
    word.lower() for word in words if word.isalpha() and 4 <= len(word) <= 10
]


# Generar una palabra aleatoria
def generate_random_word():
    word = random.choice(valid_words)
    normalized_word = (
        unicodedata.normalize("NFKD", word).encode("ASCII", "ignore").decode("utf-8")
    )
    return normalized_word


# Generar una lista de palabras aleatorias
def generate_random_words(num_words):
    return [generate_random_word() for _ in range(num_words)]


# Cantidad de palabras
num_words = random.randint(5, 10)


# Tamaño de la sopa de letras
rows = 15
cols = 15

# Lista de palabras aleatorias
words = generate_random_words(num_words)

# Matriz de la sopa de letras
grid = [["-" for _ in range(cols)] for _ in range(rows)]


# Clase para generar una palabra en un hilo separado
class WordGeneratorThread(threading.Thread):
    def __init__(self, word):
        threading.Thread.__init__(self)
        self.word = word

    def run(self):
        place_word(self.word)


# Lista de hilos para generar las palabras
threads = []


# Función para colocar una palabra en la sopa de letras
def place_word(word):
    word_length = len(word)

    # Direcciones posibles para colocar la palabra
    directions = [(0, 1), (1, 0), (1, 1), (-1, 0), (0, -1), (-1, -1), (1, -1), (-1, 1)]

    # Buscar una posición válida para colocar la palabra
    while True:
        # Posición inicial aleatoria
        start_row = random.randint(0, rows - 1)
        start_col = random.randint(0, cols - 1)

        # Dirección aleatoria
        direction = random.choice(directions)
        dir_row, dir_col = direction

        # Verificar si la palabra cabe en esa posición y dirección
        end_row = start_row + dir_row * (word_length - 1)
        end_col = start_col + dir_col * (word_length - 1)
        if 0 <= end_row < rows and 0 <= end_col < cols:
            valid = True
            for i in range(word_length):
                row = start_row + i * dir_row
                col = start_col + i * dir_col
                if grid[row][col] != "-" and grid[row][col] != word[i]:
                    valid = False
                    break
            if valid:
                # Colocar la palabra en la sopa de letras
                for i in range(word_length):
                    row = start_row + i * dir_row
                    col = start_col + i * dir_col
                    grid[row][col] = word[i]
                break


# Crear un hilo para cada palabra y comenzar su ejecución
for word in words:
    thread = WordGeneratorThread(word)
    threads.append(thread)
    thread.start()


# Esperar a que todos los hilos terminen
for thread in threads:
    thread.join
    # Llenar los espacios vacíos con letras aleatorias
for i in range(rows):
    for j in range(cols):
        if grid[i][j] == "-":
            grid[i][j] = random.choice(string.ascii_lowercase)

# Imprimir la sopa de letras sin signos especiales
for row in grid:
    print(" ".join(row).replace("-", " "))


# Función para obtener la sopa de letras como una lista de listas
def get_grid_as_list():
    return grid


# Guardar la sopa de letras en un archivo
def save_grid_to_file(filename):
    with open(filename, "w") as file:
        for row in grid:
            file.write(" ".join(row).replace("-", " ") + "\n")


grid_list = get_grid_as_list()
print(grid_list)
save_grid_to_file("sopa_de_letras.txt")
