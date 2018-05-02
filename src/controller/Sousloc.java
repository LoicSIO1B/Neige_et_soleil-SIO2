package controller;

public class Sousloc 
{
	private int idContratSousLoc;
	private String sousLocDebut, sousLocFin;
	
	public Sousloc()
	{
		this.idContratSousLoc = 0;
		this.sousLocDebut = "";
		this.sousLocFin = "";
	}
	
	public Sousloc(int idContratSousLoc, String sousLocDebut, String sousLocFin)
	{
		this.idContratSousLoc = 0;
		this.sousLocDebut = sousLocDebut;
		this.sousLocFin = sousLocFin;
	}
	
	public Sousloc(String sousLocDebut, String sousLocFin)
	{
		this.idContratSousLoc = 0;
		this.sousLocDebut = sousLocDebut;
		this.sousLocFin = sousLocFin;
	}

	public int getIdContratSousLoc() {
		return idContratSousLoc;
	}

	public void setIdContratSousLoc(int idContratSousLoc) {
		this.idContratSousLoc = idContratSousLoc;
	}

	public String getSousLocDebut() {
		return sousLocDebut;
	}

	public void setSousLocDebut(String sousLocDebut) {
		this.sousLocDebut = sousLocDebut;
	}

	public String getSousLocFin() {
		return sousLocFin;
	}

	public void setSousLocFin(String sousLocFin) {
		this.sousLocFin = sousLocFin;
	}
}