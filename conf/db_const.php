<?php 
const DB_TB_KUNDEN = "Kunden";
const DB_F_KUNDEN_ID = "EMail";
const DB_F_KUNDEN_EMAIL = "EMail";
const DB_F_KUNDEN_VORNAME = "Vorname";
const DB_F_KUNDEN_NACHNAME = "Nachname";
const DB_F_KUNDEN_TELNR = "TelNr";
const DB_F_KUNDEN_FOTO = "Foto";
const DB_F_KUNDEN_FREISCHALTUNG = "Freischaltung";

const DB_TB_MITARBEITER = "Mitarbeiter";
const DB_F_MITARBEITER_ID = "SVNr";
const DB_F_MITARBEITER_SVNR = "SVNr";
const DB_F_MITARBEITER_VORNAME = "Vorname";
const DB_F_MITARBEITER_NACHNAME = "Nachname";
const DB_F_MITARBEITER_ADMIN = "Admin";

const DB_TB_SKILLS = "Skills";
const DB_F_SKILLS_ID = "ID";
const DB_F_SKILLS_BESCHREIBUNG = "Beschreibung";

const DB_TB_MITARBEITER_SKILLS = "Mitarbeiter_has_Skills";
const DB_F_MITARBEITER_SKILLS_MITARBEITER = "Mitarbeiter_SVNr";
const DB_F_MITARBEITER_SKILLS_SKILLS = "Skills_Bez";

const DB_TB_ARBEITSPLATZRESSOURCEN = "Arbeitsplatzressourcen";
const DB_F_ARBEITSPLATZRESSOURCEN_ID = "ArbeitsplatzNr";
const DB_F_ARBEITSPLATZRESSOURCEN_NUMMER = "ArbeitsplatzNr";
const DB_F_ARBEITSPLATZRESSOURCEN_NAME = "Arbeitsplatzname";

const DB_TB_ARBEITSPLATZAUSSTATTUNGEN = "Arbeitsplatzausstattungen";
const DB_F_ARBEITSPLATZAUSSTATTUNGEN_ID = "ID";
const DB_F_ARBEITSPLATZAUSSTATTUNGEN_NAME = "Ausstattung";

const DB_TB_ARBEITSPLATZRESSOURCEN_ARBEITSPLATZAUSSTATTUNGEN = "Arbeitsplatzressourcen_has_Arbeitsplatzausstattungen";
const DB_F_ARBEITSPLATZRESSOURCEN_ARBEITSPLATZAUSSTATTUNGEN_ARBEITSPLATZRESSOURCEN = "Arbeitsplatzressourcen_ArbeitsplatzNr";
const DB_F_ARBEITSPLATZRESSOURCEN_ARBEITSPLATZAUSSTATTUNGEN_ARBEITSPLATZAUSSTATTUNGEN = "Arbeitsplatzausstattungen_ID";

const DB_TB_DIENSTLEISTUNGEN = "Dienstleistungen";
const DB_F_DIENSTLEISTUNGEN_ID = "Kuerzel";
const DB_F_DIENSTLEISTUNGEN_KUERZEL = "Kuerzel"; 
const DB_F_DIENSTLEISTUNGEN_NAME = "Dienstleistung";
const DB_F_DIENSTLEISTUNGEN_BENOETIGTEEINHEITEN = "BenoetigteEinheiten";
const DB_F_DIENSTLEISTUNGEN_PAUSENEINHEITEN = "PausenEinheiten";

const DB_TB_DIENSTLEISTUNGEN_SKILLS = "Dienstleistungen_has_Skills";
const DB_F_DIENSTLEISTUNGEN_SKILLS_DIENSTLEISTUNGEN = "Dienstleistungen_Kuerzel";
const DB_F_DIENSTLEISTUNGEN_SKILLS_SKILLS = "Skills_ID";

const DB_TB_DIENSTLEISTUNGEN_ARBEITSPLATZAUSSTATTUNGEN = "Dienstleistungen_has_Arbeitsplatzausstattungen";
const DB_F_DIENSTLEISTUNGEN_ARBEITSPLATZAUSSTATTUNGEN_DIENSTLEISTUNGEN = "Dienstleistungen_Kuerzel";
const DB_F_DIENSTLEISTUNGEN_ARBEITSPLATZAUSSTATTUNGEN_ARBEITSPLATZAUSSTATTUNGEN = "Arbeitsplatzausstattungen_ID";

//...

const DB_VIEW_ZEITTABELLE = "View_Zeittabelle"; 
const DB_VIEW_MITARBEITER_SKILLS = "View_MitarbeiterSkills";

const DB_PC_FREIE_TERMINE = "FreieTermine";

const DB_PC_TERMIN_EINTRAGEN = "TerminEintragen";

?>