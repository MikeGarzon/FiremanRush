using System.Collections;
using System.Collections.Generic;
using System.Security.Cryptography;
using UnityEngine;

public class Personaje : MonoBehaviour
{
    Rigidbody2D caballeroRB;
    public float maxVelocidad;
     float mover;
    
    
    //voltear caballero
    bool voltearCaballero = true;
    SpriteRenderer caballeroRender;
        
    // Start is called before the first frame update
    void Start(){
        caballeroRB = GetComponent<Rigidbody2D> ();
        caballeroRender = GetComponent<SpriteRenderer> ();

    }

    // Update is called once per frame
    void Update()
    {

        mover = Input.GetAxis("Horizontal");
        
        if (mover > 0 && !voltearCaballero)
        {
            voltear();

        }
        else if (mover < 0 && voltearCaballero)
        {
            voltear();
        }

        caballeroRB.velocity = new Vector2(mover * maxVelocidad, caballeroRB.velocity.y);

    }

    void voltear()
    {
        voltearCaballero = !voltearCaballero;
        caballeroRender.flipX = !caballeroRender.flipX;

    }

}

