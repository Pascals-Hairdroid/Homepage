<?php 


// TABELLEN

const DB_TB_MITARBEITER = "Mitarbeiter";
const DB_F_MITARBEITER_PK_SVNR = "SVNr";
const DB_F_MITARBEITER_VORNAME = "Vorname";
const DB_F_MITARBEITER_NACHNAME = "Nachname";
const DB_F_MITARBEITER_ADMIN = "Admin";

const DB_TB_SKILLS = "Skills";
const DB_F_SKILLS_PK_ID = "ID";
const DB_F_SKILLS_BESCHREIBUNG = "Beschreibung";

const DB_TB_ARBEITSPLATZRESSOURCEN = "Arbeitsplatzressourcen";
const DB_F_ARBEITSPLATZRESSOURCEN_PK_NUMMER = "ArbeitsplatzNr";
const DB_F_ARBEITSPLATZRESSOURCEN_NAME = "Arbeitsplatzname";

const DB_TB_ARBEITSPLATZAUSSTATTUNGEN = "Arbeitsplatzausstattungen";
const DB_F_ARBEITSPLATZAUSSTATTUNGEN_PK_ID = "ID";
const DB_F_ARBEITSPLATZAUSSTATTUNGEN_NAME = "Ausstattung";

const DB_TB_DIENSTLEISTUNGEN = "Dienstleistungen";
const DB_F_DIENSTLEISTUNGEN_PK_KUERZEL = "Kuerzel"; 
const DB_F_DIENSTLEISTUNGEN_NAME = "Dienstleistung";
const DB_F_DIENSTLEISTUNGEN_BENOETIGTEEINHEITEN = "BenoetigteEinheiten";
const DB_F_DIENSTLEISTUNGEN_PAUSENEINHEITEN = "PausenEinheiten";

const DB_TB_WERBUNG = "Werbung";
const DB_F_WERBUNG_PK_NUMMER = "WerbungsNr";

const DB_TB_INTERESSEN = "Interessen";
const DB_F_INTERESSEN_PK_ID = "ID";
const DB_F_INTERESSEN_BEZEICHNUNG = "Bez";

const DB_TB_KUNDEN = "Kunden";
const DB_F_KUNDEN_PK_EMAIL = "EMail";
const DB_F_KUNDEN_VORNAME = "Vorname";
const DB_F_KUNDEN_NACHNAME = "Nachname";
const DB_F_KUNDEN_TELNR = "TelNr";
const DB_F_KUNDEN_FOTO = "Foto";
const DB_F_KUNDEN_FREISCHALTUNG = "Freischaltung";

const DB_TB_PRODUKTE = "Produkte";
const DB_F_PRODUKTE_PK_ID = "ID";
const DB_F_PRODUKTE_NAME = "Produktname";
const DB_F_PRODUKTE_HERSTELLER = "Hersteller";
const DB_F_PRODUKTE_BESCHREIBUNG = "Beschreibung";
const DB_F_PRODUKTE_PREIS = "Preis";
const DB_F_PRODUKTE_BESTAND = "Bestand";

const DB_TB_WOCHENTAGE = "Wochentage";
const DB_F_WOCHENTAGE_PK_KUERZEL = "Kuerzel";
const DB_F_WOCHENTAGE_BEZEICHNUNG = "Bezeichnung";

// MULTI PK
const DB_TB_URLAUB = "Urlaub";
const DB_F_URLAUB_PK_MITARBEITER = "Mitarbeiter_SVNr";
const DB_F_URLAUB_PK_BEGINN = "Beginn";
const DB_F_URLAUB_ENDE = "Ende";

// Zwischentabellen (MULTI PK)
// Informationenbeinhaltende Zwischentabellen
const DB_TB_DIENSTZEITEN = "Dienstzeiten";
const DB_F_DIENSTZEITEN_PK_MITARBEITER = "Mitarbeiter_ID";
const DB_F_DIENSTZEITEN_PK_WOCHENTAGE = "Wochentage_Kuerzel";
const DB_F_DIENSTZEITEN_BEGINN = "Beginn";
const DB_F_DIENSTZEITEN_ENDE = "Ende";

const DB_TB_ZEITTABELLE = "Zeittabelle";
const DB_F_ZEITTABELLE_PK_ZEITSTEMPEL = "Zeitstempel";
const DB_F_ZEITTABELLE_PK_MITARBEITER = "Mitarbeiter";
const DB_F_ZEITTABELLE_ARBEITSPLATZ = "ArbeitsplatzNr";
const DB_F_ZEITTABELLE_KUNDE = "Kunden_EMail";
const DB_F_ZEITTABELLE_FRISURWUNSCH = "FrisurwunschFoto";
const DB_F_ZEITTABELLE_DIENSTLEISTUNG = "Dienstleistung";

// M:N Zwischentabellen
const DB_TB_MITARBEITER_SKILLS = "Mitarbeiter_has_Skills";
const DB_F_MITARBEITER_SKILLS_PK_MITARBEITER = "Mitarbeiter_SVNr";
const DB_F_MITARBEITER_SKILLS_PK_SKILLS = "Skills_Bez";

const DB_TB_ARBEITSPLATZRESSOURCEN_ARBEITSPLATZAUSSTATTUNGEN = "Arbeitsplatzressourcen_has_Arbeitsplatzausstattungen";
const DB_F_ARBEITSPLATZRESSOURCEN_ARBEITSPLATZAUSSTATTUNGEN_PK_ARBEITSPLATZRESSOURCEN = "Arbeitsplatzressourcen_ArbeitsplatzNr";
const DB_F_ARBEITSPLATZRESSOURCEN_ARBEITSPLATZAUSSTATTUNGEN_PK_ARBEITSPLATZAUSSTATTUNGEN = "Arbeitsplatzausstattungen_ID";

const DB_TB_DIENSTLEISTUNGEN_SKILLS = "Dienstleistungen_has_Skills";
const DB_F_DIENSTLEISTUNGEN_SKILLS_PK_DIENSTLEISTUNGEN = "Dienstleistungen_Kuerzel";
const DB_F_DIENSTLEISTUNGEN_SKILLS_PK_SKILLS = "Skills_ID";

const DB_TB_DIENSTLEISTUNGEN_ARBEITSPLATZAUSSTATTUNGEN = "Dienstleistungen_has_Arbeitsplatzausstattungen";
const DB_F_DIENSTLEISTUNGEN_ARBEITSPLATZAUSSTATTUNGEN_PK_DIENSTLEISTUNGEN = "Dienstleistungen_Kuerzel";
const DB_F_DIENSTLEISTUNGEN_ARBEITSPLATZAUSSTATTUNGEN_PK_ARBEITSPLATZAUSSTATTUNGEN = "Arbeitsplatzausstattungen_ID";

const DB_TB_WERBUNG_INTERESSEN = "Werbung_has_Interessen";
const DB_F_WERBUNG_INTERESSEN_PK_WERBUNG = "Werbung_WerbungsNr";
const DB_F_WERBUNG_INTERESSEN_PK_INTERESSEN= "Interessen_ID";

const DB_TB_KUNDEN_INTERESSEN ="Kunden_has_Interessen";
const DB_F_KUNDEN_INTERESSEN_PK_KUNDEN = "Kunden_EMail";
const DB_F_KUNDEN_INTERESSEN_PK_INTERESSEN = "Interessen_ID";


// Views

const DB_VIEW_ZEITTABELLE = "View_Zeittabelle"; 

const DB_VIEW_MITARBEITER_SKILLS = "View_MitarbeiterSkills";


// Procedures

const DB_PC_FREIE_TERMINE = "FreieTermine";


const DB_PC_TERMIN_EINTRAGEN = "TerminEintragen";
const DB_PC_TERMIN_STORNIEREN = "TerminStornieren";

?>