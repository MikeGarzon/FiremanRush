using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking; 
using UnityEngine.SceneManagement;

[CreateAssetMenu(fileName= "Server", menuName = "FireManServer", order = 1)]
public class Servidor : ScriptableObject
{
    public string servidor;
    public Servicio[] servicios;

    public bool ocupado = false;
    public Respuesta respuesta;
    
        
    public IEnumerator ConsumirServicio(string nombre, string[] datos)
    {
        ocupado = true;
        WWWForm formulario = new WWWForm();
        Servicio s = new Servicio();

        for (int i = 0; i < servicios.Length; i++)
        {
            if (servicios[i].nombre.Equals(nombre))
            {
                s = servicios[i];
            }
        }

        for (int i = 0; i < s.parametros.Length; i++)
        {
            formulario.AddField(s.parametros[i], datos[i]);
        }

        UnityWebRequest www = UnityWebRequest.Post(servidor + "/" + s.URL, formulario);
        Debug.Log(servidor + "/" + s.URL);
        yield return www.SendWebRequest();

        if (www.result != UnityWebRequest.Result.Success)
        {
            respuesta = new Respuesta();
            Debug.Log("error en la respuesta");
        }
        else
        {
            if (www.downloadHandler.text == "Login fallido")
            {
                Debug.Log("Login Fallido");
                yield break;
            }
            else
            {
                string temp = www.downloadHandler.text;
                temp = temp.Replace('#', '"');
                Debug.Log(temp);
                respuesta = JsonUtility.FromJson<Respuesta>(temp); 
                SceneManager.LoadScene(SceneManager.GetActiveScene().buildIndex - 4);
            }
        }
        ocupado = false;
    }
}


[System.Serializable]
public class Servicio
{
    public string nombre;
    public string URL;
    public string[] parametros;
}

public class Respuesta
{
    public string username;
    public string password;
    public int score;
    
    
}