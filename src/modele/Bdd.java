package modele;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Bdd 
{
	//Variables d'accès à la bdd
	private String serveur, bdd, user, mdp;
	private Connection maConnexion;
	
	//Constructeur
	public Bdd(String serveur, String bdd, String user, String mdp)
	{
		this.serveur=serveur;
		this.bdd=bdd;
		this.user=user;
		this.mdp=mdp;
		this.maConnexion=null;
	}
	
	//On verifie la présence du driver mysql dans la librairie
	public void chargerPilote()
	{
		try
		{
			Class.forName("com.mysql.jdbc.Driver");
		}
		catch(ClassNotFoundException exp)
		{
			System.out.println("Erreur: pilote inexistant");
		}
	}
	
		//Mechanisme de connexion à la base
		public void seConnecter()
		{
			this.chargerPilote();
			String url="jdbc:mysql://"+this.serveur+"/"+this.bdd;
			try
			{
				this.maConnexion = DriverManager.getConnection(url,this.user,this.mdp);
			}
			catch(SQLException exp)
			{
				System.out.println("Erreur de connexion à : " + url);
		}
	}		
		
		//Deconnexion
		public void seDeConnecter()
		{
			try
			{
				if(this.maConnexion != null)
				{
					this.maConnexion.close();
				}
			}
			catch(SQLException exp)
			{
				System.out.println("Erreur de fermeture de la connexion !");
			}
		}
		
		//Getter
		public Connection getMaConnexion()
		{
			return this.maConnexion;
		}
	}