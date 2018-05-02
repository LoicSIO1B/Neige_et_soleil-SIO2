package controller;

public class Proprietaire 
{
	private int idPropri, cpPropri;
	private String nomPropri, prenomPropri, mdpPropri, adressePropri, villePropri, 
	telPropri, mailPropri;
	
	public Proprietaire()
	{
		this.idPropri = 0;
		this.cpPropri = 0;
		this.nomPropri = "";
		this.prenomPropri = "";
		this.mdpPropri = "";
		this.adressePropri = "";
		this.villePropri = "";
		this.telPropri = "";
		this.mailPropri = "";
	}
	
	public Proprietaire(int idPropri, int cpPropri, String nomPropri, 
			String prenomPropri, String mdpPropri, String adressePropri,
			String villePropri, String telPropri)
	{
		this.idPropri = 0;
		this.cpPropri = 0;
		this.nomPropri = nomPropri;
		this.prenomPropri = prenomPropri;
		this.mdpPropri = mdpPropri;
		this.adressePropri = adressePropri;
		this.villePropri = villePropri;
		this.telPropri = telPropri;
		this.mailPropri = "";
	}
	
	public Proprietaire(int cpPropri, String nomPropri, 
			String prenomPropri, String mdpPropri, String adressePropri,
			String villePropri, String telPropri)
	{
		this.idPropri = 0;
		this.cpPropri = 0;
		this.nomPropri = nomPropri;
		this.prenomPropri = prenomPropri;
		this.mdpPropri = mdpPropri;
		this.adressePropri = adressePropri;
		this.villePropri = villePropri;
		this.telPropri = telPropri;
		this.mailPropri = "";
	}

	public int getIdPropri() {
		return idPropri;
	}

	public void setIdPropri(int idPropri) {
		this.idPropri = idPropri;
	}

	public int getCpPropri() {
		return cpPropri;
	}

	public void setCpPropri(int cpPropri) {
		this.cpPropri = cpPropri;
	}

	public String getNomPropri() {
		return nomPropri;
	}

	public void setNomPropri(String nomPropri) {
		this.nomPropri = nomPropri;
	}

	public String getPrenomPropri() {
		return prenomPropri;
	}

	public void setPrenomPropri(String prenomPropri) {
		this.prenomPropri = prenomPropri;
	}

	public String getMdpPropri() {
		return mdpPropri;
	}

	public void setMdpPropri(String mdpPropri) {
		this.mdpPropri = mdpPropri;
	}

	public String getAdressePropri() {
		return adressePropri;
	}

	public void setAdressePropri(String adressePropri) {
		this.adressePropri = adressePropri;
	}

	public String getVillePropri() {
		return villePropri;
	}

	public void setVillePropri(String villePropri) {
		this.villePropri = villePropri;
	}

	public String getTelPropri() {
		return telPropri;
	}

	public void setTelPropri(String telPropri) {
		this.telPropri = telPropri;
	}

	public String getMailPropri() {
		return mailPropri;
	}

	public void setMailPropri(String mailPropri) {
		this.mailPropri = mailPropri;
	}
}