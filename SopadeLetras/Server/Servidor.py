import importlib
import socket
import time
import json


# Configuración del servidor
host = "localhost"
port = 5000

# Crear el socket del servidor
server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
server_socket.bind((host, port))
server_socket.listen(5)

print("Servidor en ejecución. Esperando conexiones...")

while True:
    # Esperar a que un cliente se conecte
    client_socket, addr = server_socket.accept()
    print("Cliente conectado:", addr)

    try:
        # Importar el módulo SopadeLetras
        sopadeletras_module = importlib.import_module("SopadeLetras")
        # Recargar el módulo para obtener la versión actualizada
        sopadeletras_module = importlib.reload(sopadeletras_module)

        # Obtener la sopa de letras y las palabras como una lista de listas
        grid_list = sopadeletras_module.get_grid_as_list()

        # Convertir la sopa de letras y las palabras a JSON
        grid_json = json.dumps(grid_list)
        words_json = json.dumps(sopadeletras_module.words)

        # Enviar la sopa de letras al cliente
        client_socket.sendall(grid_json.encode())

        # Esperar un segundo antes de enviar las palabras
        # Esto se hace para asegurar que el cliente haya recibido y procesado la sopa de letras antes de las palabras
        time.sleep(1)

        # Enviar las palabras al cliente
        client_socket.sendall(words_json.encode())

        print("Datos enviados al cliente.")

    except Exception as e:
        print("Error al enviar los datos al cliente:", str(e))

    finally:
        # Cerrar la conexión con el cliente
        client_socket.close()
