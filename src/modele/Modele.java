package modele;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class Modele 
{
	public static String verifConnexion (String login, String mdp)
	{
		String droits="";
		String requete = " select count(*) as nb, droits"
				+ " from user "
				+ "where login ='" + login +"' and "
				+ " mdp = '" + mdp +"' ;";
		
		Bdd uneBdd = new Bdd ("localhost", "intervention", "root", "");
		try
		{
			uneBdd.seConnecter();
			Statement unStat = uneBdd.getMaConnexion().createStatement();
			ResultSet unRes = unStat.executeQuery(requete);
			if (unRes.next())
			{
				int nb = unRes.getInt("nb");
				if (nb > 0)
				{
					droits = unRes.getString("droits");
				}
			}
			unStat.close();
			unRes.close();
			uneBdd.seConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur : " + requete);
		}
		return droits;
	}
}
