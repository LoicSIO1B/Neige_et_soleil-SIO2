package controller;

public class Membre 
{
	private int idMembre, cpMembre;
	private String nomMembre, prenomMembre, mdpMembre, adresseMembre, villeMembre, 
	telMembre, mailMembre;
	
	public Membre()
	{
		this.idMembre = 0;
		this.cpMembre = 0;
		this.nomMembre = "";
		this.prenomMembre = "";
		this.mdpMembre = "";
		this.adresseMembre = "";
		this.villeMembre = "";
		this.telMembre = "";
		this.mailMembre = "";
	}
	
	public Membre(int idMembre, int cpMembre, String nomMembre, String prenomMembre,
			String mdpMembre, String adresseMembre, String villeMembre, 
			String telMembre, String mailMembre)
	{
		this.idMembre = 0;
		this.cpMembre = 0;
		this.nomMembre = nomMembre;
		this.prenomMembre = prenomMembre;
		this.mdpMembre = mdpMembre;
		this.adresseMembre = adresseMembre;
		this.villeMembre = villeMembre;
		this.telMembre = telMembre;
		this.mailMembre = mailMembre;
	}
	
	public Membre(int cpMembre, String nomMembre, String prenomMembre,
			String mdpMembre, String adresseMembre, String villeMembre, 
			String telMembre, String mailMembre)
	{
		this.idMembre = 0;
		this.cpMembre = 0;
		this.nomMembre = nomMembre;
		this.prenomMembre = prenomMembre;
		this.mdpMembre = mdpMembre;
		this.adresseMembre = adresseMembre;
		this.villeMembre = villeMembre;
		this.telMembre = telMembre;
		this.mailMembre = mailMembre;
	}

	public int getIdMembre() {
		return idMembre;
	}

	public void setIdMembre(int idMembre) {
		this.idMembre = idMembre;
	}

	public int getCpMembre() {
		return cpMembre;
	}

	public void setCpMembre(int cpMembre) {
		this.cpMembre = cpMembre;
	}

	public String getNomMembre() {
		return nomMembre;
	}

	public void setNomMembre(String nomMembre) {
		this.nomMembre = nomMembre;
	}

	public String getPrenomMembre() {
		return prenomMembre;
	}

	public void setPrenomMembre(String prenomMembre) {
		this.prenomMembre = prenomMembre;
	}

	public String getMdpMembre() {
		return mdpMembre;
	}

	public void setMdpMembre(String mdpMembre) {
		this.mdpMembre = mdpMembre;
	}

	public String getAdresseMembre() {
		return adresseMembre;
	}

	public void setAdresseMembre(String adresseMembre) {
		this.adresseMembre = adresseMembre;
	}

	public String getVilleMembre() {
		return villeMembre;
	}

	public void setVilleMembre(String villeMembre) {
		this.villeMembre = villeMembre;
	}

	public String getTelMembre() {
		return telMembre;
	}

	public void setTelMembre(String telMembre) {
		this.telMembre = telMembre;
	}

	public String getMailMembre() {
		return mailMembre;
	}

	public void setMailMembre(String mailMembre) {
		this.mailMembre = mailMembre;
	}
}