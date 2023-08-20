# Se utiliza para acceder a variables de entorno
import os
# Realiza tareas relacionadas con el procesamiento de lenguaje natural.
import openai
# Se utiliza para cargar la clave de API de OpenAI desde el archivo ".env".
from dotenv import load_dotenv
# Se utiliza para crear una aplicación web y definir rutas para manejar las solicitudes HTTP.
from flask import Flask, render_template, request
# Transcribir audio a texto.
from transcriber import Transcriber
from llm import LLM
# Realizar síntesis de voz (Text-to-Speech).
from tts import TTS
from pc_command import PcCommand

# Cargar llaves desde el archivo .env utilizando las funciones load_dotenv y os.getenv:
load_dotenv()
openai.api_key = os.getenv('OPENAI_API_KEY')
# elevenlabs_key = os.getenv('ELEVENLABS_API_KEY')

app = Flask(__name__)

#Se crea una ruta raíz ("/") que renderiza el template "recorder.html" cuando se accede a ella.
#Significa que cuando alguien visita la página principal del sitio web, se muestra el contenido
#del archivo "recorder.html".

@app.route("/")
def index():
    return render_template("recorder.html")

#La ruta "/audio" está definida para aceptar solicitudes POST que contienen archivos de audio.
# El audio se transcribe utilizando una instancia de la clase "Transcriber" y el resultado se guarda en
# la variable text


@app.route("/audio", methods=["POST"])
def audio():
    #Obtener audio grabado y transcribirlo
    audio = request.files.get("audio")
    text = Transcriber().transcribe(audio)

    # Utilizar el LLM para analizar el texto transcrito y determinar si se menciona
    # alguna función específica. Dependiendo de la función detectada, se ejecuta la lógica
    # correspondiente para cada función.
    llm = LLM()
    function_name, args, message = llm.process_functions(text)
    if function_name is not None:
        # Si se desea llamar una funcion de las que tenemos
        if function_name == "open_chrome":
            PcCommand().open_chrome(args["website"])
            final_response = "Listo, ya abrí chrome en el sitio " + args["website"]
            tts_file = TTS().process(final_response)
            return {"result": "ok", "text": final_response, "file": tts_file}

        elif function_name == "cuidado":
            PcCommand().open_chrome(args["website"])
            final_response = "Listo, ya abrí chrome en el sitio deseado para el cuidado de tu canino"
            tts_file = TTS().process(final_response)
            return {"result": "ok", "text": final_response, "file": tts_file}

        elif function_name == "VideoCuidado":
            PcCommand().open_chrome(args["website"])
            final_response = "Listo, ya abrí Youtube en un video sobre cuidados de tu canino"
            tts_file = TTS().process(final_response)
            return {"result": "ok", "text": final_response, "file": tts_file}

        elif function_name == "emergencia":
            PcCommand().open_chrome(args["website"])
            final_response = "Listo, ya abrí chrome en el sitio deseado para la emergencia de tu canino"
            tts_file = TTS().process(final_response)
            return {"result": "ok", "text": final_response, "file": tts_file}

        elif function_name == "emergenciaspdf":
            PcCommand().open_chrome(args["website"])
            final_response = "Listo, ya abrí chrome en el pdf para la emergencia de tu cachorro"
            tts_file = TTS().process(final_response)
            return {"result": "ok", "text": final_response, "file": tts_file}

        else:
            final_response = "Estimado usuario, no tengo idea de lo que estás hablando"
            tts_file = TTS().process(final_response)
            return {"result": "ok", "text": final_response, "file": tts_file}