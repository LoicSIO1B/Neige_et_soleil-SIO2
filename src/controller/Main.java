package controller;

import vue.VueConnexion;

public class Main 
{
	public static VueConnexion uneVueConnexion;
	
	public void rendreVisible (boolean action)
	{
		Main.uneVueConnexion.setVisible(action);
	}
	
	public static void main(String[] args) 
	{
		Main.uneVueConnexion = new VueConnexion();
	}
}