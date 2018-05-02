package controller;

public class Appartement 
{
	private int idAppartement, CPAppartement;
	private String nomAppartement, numImmeuble, adresseAppartement, villeAppartement,
	type, dateDebutDispo, dateFinDispo;
	private double prixAppartement;
	
	public Appartement()
	{
		this.idAppartement = 0;
		this.CPAppartement = 0;
		this.nomAppartement = "";
		this.numImmeuble = "";
		this.adresseAppartement = "";
		this.villeAppartement = "";
		this.type = "";
		this.dateDebutDispo = "";
		this.dateFinDispo = "";
		this.prixAppartement = 0;
	}
	
	public Appartement(int idAppartement, int CPAppartement, String nomAppartement, 
			String numImmeuble, String adresseAppartement, String villeAppartement, 
			String type, String dateDebutDispo, String dateFinDispo, 
			double prixAppartement)
	{
		this.idAppartement = 0;
		this.CPAppartement = 0;
		this.nomAppartement = nomAppartement;
		this.numImmeuble = "";
		this.adresseAppartement = numImmeuble;
		this.villeAppartement = villeAppartement;
		this.type = type;
		this.dateDebutDispo = dateDebutDispo;
		this.dateFinDispo = dateFinDispo;
		this.prixAppartement = 0;
	}
	
	public Appartement(int CPAppartement, String nomAppartement, 
			String numImmeuble, String adresseAppartement, String villeAppartement, 
			String type, String dateDebutDispo, String dateFinDispo, 
			double prixAppartement)
	{
		this.idAppartement = 0;
		this.CPAppartement = 0;
		this.nomAppartement = nomAppartement;
		this.numImmeuble = "";
		this.adresseAppartement = numImmeuble;
		this.villeAppartement = villeAppartement;
		this.type = type;
		this.dateDebutDispo = dateDebutDispo;
		this.dateFinDispo = dateFinDispo;
		this.prixAppartement = 0;
	}

	public int getIdAppartement() {
		return idAppartement;
	}

	public void setIdAppartement(int idAppartement) {
		this.idAppartement = idAppartement;
	}

	public int getCPAppartement() {
		return CPAppartement;
	}

	public void setCPAppartement(int cPAppartement) {
		CPAppartement = cPAppartement;
	}

	public String getNomAppartement() {
		return nomAppartement;
	}

	
	public void setNomAppartement(String nomAppartement) {
		this.nomAppartement = nomAppartement;
	}

	public String getNumImmeuble() {
		return numImmeuble;
	}

	public void setNumImmeuble(String numImmeuble) {
		this.numImmeuble = numImmeuble;
	}

	public String getAdresseAppartement() {
		return adresseAppartement;
	}

	public void setAdresseAppartement(String adresseAppartement) {
		this.adresseAppartement = adresseAppartement;
	}

	public String getVilleAppartement() {
		return villeAppartement;
	}

	public void setVilleAppartement(String villeAppartement) {
		this.villeAppartement = villeAppartement;
	}

	public String getType() {
		return type;
	}

	public void setType(String type) {
		this.type = type;
	}

	public String getDateDebutDispo() {
		return dateDebutDispo;
	}

	public void setDateDebutDispo(String dateDebutDispo) {
		this.dateDebutDispo = dateDebutDispo;
	}

	public String getDateFinDispo() {
		return dateFinDispo;
	}

	public void setDateFinDispo(String dateFinDispo) {
		this.dateFinDispo = dateFinDispo;
	}

	public double getPrixAppartement() {
		return prixAppartement;
	}

	public void setPrixAppartement(double prixAppartement) {
		this.prixAppartement = prixAppartement;
	}	
}

