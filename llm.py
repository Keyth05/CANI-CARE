import openai
import json

# Clase para utilizar cualquier LLM para procesar un texto y regresar una funcion a llamar con sus parametros
# Usamos el modelo 0613
class LLM():
    def __init__(self):
        pass

    def process_functions(self, text):
        response = openai.ChatCompletion.create(
            model="gpt-3.5-turbo-0613",
            messages=[
                {"role": "system", "content":
                    "Eres un asistente de recomendaciones para cuidados y emergencias de caninos"},
                {"role": "user", "content": text},
            ], functions=[
                {
                    "name": "open_chrome",
                    "description": "Abrir el explorador Chrome en un sitio específico",
                    "parameters": {
                        "type": "object",
                        "properties": {
                            "website": {
                                "type": "string",
                                "description": "El sitio al cual se desea ir"
                            }
                        }
                    }
                },
                {
                    "name": "cuidado",
                    "description": "Abrir el explorador Chrome en el link de cuidados caninos",
                    "parameters": {
                        "type": "object",
                        "properties": {
                            "website": {
                                "type": "string",
                                "description": "https://postgradoveterinaria.com/cuidados-perro-recomendaciones-basicas"

                            }
                        }
                    }
                },
                {
                    "name": "emergencia",
                    "description": "Abrir el explorador Chrome en el link de emergencia para perros ",
                    "parameters": {
                        "type": "object",
                        "properties": {
                            "website": {
                                "type": "string",
                                "description":
                                    "https://www.ringo.com.co/actualidad-perruna/casos-de-emergencia-con-mi-perro "
                            }
                        }
                    }
                },
                {
                    "name": "pdf",
                    "description": "Abrir el explorador Chrome en el link de pdf para cuidados de cachorros ",
                    "parameters": {
                        "type": "object",
                        "properties": {
                            "website": {
                                "type": "string",
                                "description":
                                "https://centauroveterinarios.com/wp-content/uploads/2016/03/ABC_puppyCare_es_ES.pdf"
                            }
                        }
                    }
                },
                {
                    "name": "VideoCuidado",
                    "description": "Abrir el explorador Chrome en el video de Youtube de cuidados caninos",
                    "parameters": {
                        "type": "object",
                        "properties": {
                            "website": {
                                "type": "string",
                                "description": "https://www.youtube.com/watch?v=TbgB5zH8_3E&ab_channel=ExpertoAnimal "

                            }
                        }
                    }
                },
            ],
            function_call="auto",
        )

        message = response["choices"][0]["message"]

        # Nuestro amigo GPT quiere llamar a alguna funcion?
        if message.get("function_call"):
            function_name = message["function_call"]["name"]  # Que funcion?
            args = message.to_dict()['function_call']['arguments']  # Con que datos?
            print("Funcion a llamar: " + function_name)
            args = json.loads(args)
            return function_name, args, message
            return None, None, message

# Una vez que llamamos a la funcion (e.g.)
# Podemos llamar a esta funcion con el msj original, la funcion llamada y su respuesta,
# para obtener una respuesta en lenguaje natural (en caso que la respuesta haya sido JSON por ejemplo)

    def process_response(self, text, message, function_name, function_response):
        response = openai.ChatCompletion.create(
            model="gpt-3.5-turbo-0613",
            messages=[
                # Aqui tambien puedes cambiar como se comporta
                {"role": "system", "content":
                    "Eres un asistente de recomendaciones para cuidados y emergencias de caninos"},
                {"role": "user", "content": text},
                message,
                {
                    "role": "function",
                    "name": function_name,
                    "content": function_response,
                },
            ],
        )
        return response["choices"][0]["message"]["content"]