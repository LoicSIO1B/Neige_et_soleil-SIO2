package controller;

public class ContratLocation 
{
	private int idContratLoc;
	private String dateDebutLoc, dateFinLoc;
	
	public ContratLocation()
	{
		this.idContratLoc = 0;
		this.dateDebutLoc = "";
		this.dateFinLoc = "";
	}
	
	public ContratLocation(int idContratLoc, String dateDebutLoc, String dateFinLoc)
	{
		this.idContratLoc = 0;
		this.dateDebutLoc = dateDebutLoc;
		this.dateFinLoc = dateFinLoc;
	}
	
	public ContratLocation(String dateDebutLoc, String dateFinLoc)
	{
		this.idContratLoc = 0;
		this.dateDebutLoc = dateDebutLoc;
		this.dateFinLoc = dateFinLoc;
	}

	public int getIdContratLoc() {
		return idContratLoc;
	}

	public void setIdContratLoc(int idContratLoc) {
		this.idContratLoc = idContratLoc;
	}

	public String getDateDebutLoc() {
		return dateDebutLoc;
	}

	public void setDateDebutLoc(String dateDebutLoc) {
		this.dateDebutLoc = dateDebutLoc;
	}

	public String getDateFinLoc() {
		return dateFinLoc;
	}

	public void setDateFinLoc(String dateFinLoc) {
		this.dateFinLoc = dateFinLoc;
	}
}