package controller;

public class Representant 
{
	private int idRepre;
	private String nomRepre, prenomRepre, mdpRepre, telRepre, mailRepre, 
	dateDebutDemarche, dateFinDemarche;
	
	public Representant()
	{
		this.idRepre = 0;
		this.nomRepre = "";
		this.prenomRepre = "";
		this.mdpRepre ="";
		this.telRepre = "";
		this.mailRepre = "";
		this.dateDebutDemarche = "";
		this.dateFinDemarche = "";
	}
	
	public Representant(int idRepre, String nomRepre, String prenomRepre, 
			String mdpRepre, String telRepre, String mailRepre, 
			String dateDebutDemarche, String dateFinDemarche)
	{
		this.idRepre = 0;
		this.nomRepre = nomRepre;
		this.prenomRepre = prenomRepre;
		this.mdpRepre =mdpRepre;
		this.telRepre = telRepre;
		this.mailRepre = mailRepre;
		this.dateDebutDemarche = dateDebutDemarche;
		this.dateFinDemarche = dateFinDemarche;
	}
	
	public Representant(String nomRepre, String prenomRepre, 
			String mdpRepre, String telRepre, String mailRepre, 
			String dateDebutDemarche, String dateFinDemarche)
	{
		this.idRepre = 0;
		this.nomRepre = nomRepre;
		this.prenomRepre = prenomRepre;
		this.mdpRepre =mdpRepre;
		this.telRepre = telRepre;
		this.mailRepre = mailRepre;
		this.dateDebutDemarche = dateDebutDemarche;
		this.dateFinDemarche = dateFinDemarche;
	}

	public int getIdRepre() {
		return idRepre;
	}

	public void setIdRepre(int idRepre) {
		this.idRepre = idRepre;
	}

	public String getNomRepre() {
		return nomRepre;
	}

	public void setNomRepre(String nomRepre) {
		this.nomRepre = nomRepre;
	}

	public String getPrenomRepre() {
		return prenomRepre;
	}

	public void setPrenomRepre(String prenomRepre) {
		this.prenomRepre = prenomRepre;
	}

	public String getMdpRepre() {
		return mdpRepre;
	}

	public void setMdpRepre(String mdpRepre) {
		this.mdpRepre = mdpRepre;
	}

	public String getTelRepre() {
		return telRepre;
	}

	public void setTelRepre(String telRepre) {
		this.telRepre = telRepre;
	}

	public String getMailRepre() {
		return mailRepre;
	}

	public void setMailRepre(String mailRepre) {
		this.mailRepre = mailRepre;
	}

	public String getDateDebutDemarche() {
		return dateDebutDemarche;
	}

	public void setDateDebutDemarche(String dateDebutDemarche) {
		this.dateDebutDemarche = dateDebutDemarche;
	}

	public String getDateFinDemarche() {
		return dateFinDemarche;
	}

	public void setDateFinDemarche(String dateFinDemarche) {
		this.dateFinDemarche = dateFinDemarche;
	}
}