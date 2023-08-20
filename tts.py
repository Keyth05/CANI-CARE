# Este código define una clase llamada TTS (Text-to-Speech) que se utiliza para
# convertir texto en voz utilizando una API externa llamada "ElevenLabs".

# Para interactuar con el sistema operativo, como acceder a variables de entorno y manipular rutas de archivos.
import os
# Importamos la función load_dotenv del módulo dotenv.
# Para cargar variables de entorno desde un archivo .env.
from dotenv import load_dotenv
import requests  # Para realizar solicitudes HTTP a una API externa.


class TTS():
    def __init__(self):  # Se ejecuta cuando se crea una instancia de la clase
        load_dotenv()  # Carga las variables del .env en el entorno actual.
        self.key = os.getenv('ELEVENLABS_API_KEY')  # Obtiene para la API de "ElevenLabs"

    def process(self, text):  # Método para convertir el texto en voz utilizando la API externa.
        CHUNK_SIZE = 1024  # Define el tamaño de los bloques (chunks) de datos que se leerán de la respuesta de la API.

        # Utiliza la voz especifica de Bella
        url = "https://api.elevenlabs.io/v1/text-to-speech/EXAVITQu4vr4xnSDxMaL"

        # Define los encabezados que se enviarán con la solicitud HTTP a la API. Incluye información como el tipo de contenido y la clave de API.
        headers = {
            "Accept": "audio/mpeg",
            "Content-Type": "application/json",
            "xi-api-key": self.key
        }

        # Define los datos que se enviarán en el cuerpo de la solicitud HTTP a la API.
        # Incluye el texto que se convertirá en voz y algunas configuraciones de la voz.
        data = {
            "text": text,
            "model_id": "eleven_multilingual_v1",
            "voice_settings": {
                "stability": 0.55,
                "similarity_boost": 0.55
            }
        }

        # Lo guarda en static/response.mp3 para que el sitio web
        # pueda leerlo y reproducirlo en el explorador
        file_name = "response.mp3"  #Define el nombre del archivo de audio resultante que se guardará en el sistema local.

        # Realiza una solicitud POST a la API de "ElevenLabs" para convertir el texto en voz.
        # Los datos y los encabezados se envían en formato JSON.
        response = requests.post(url, json=data, headers=headers)

        # Abre un archivo en modo binario y guarda la respuesta de la API en el archivo de audio resultante.

        with open("static/" + file_name, 'wb') as f:
            for chunk in response.iter_content(chunk_size=CHUNK_SIZE):
                if chunk:
                    f.write(chunk)

    # Devuelve el nombre del archivo de audio resultante, que luego
    # se puede utilizar para reproducir el audio en el sitio web.
        return file_name