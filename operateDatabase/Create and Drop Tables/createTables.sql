CREATE TABLE LIBRARY_AUTHOR (
AUTHORID VARCHAR(20) NOT NULL,
ANAME VARCHAR(50),
CONSTRAINT AUTHORPK 
PRIMARY KEY (AUTHORID))
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_CHIEF_EDITOR (
EDITOR_ID VARCHAR(20) NOT NULL,
ENAME VARCHAR(50),
CONSTRAINT CHIEF_EDITORPK 
PRIMARY KEY (EDITOR_ID))
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_PUBLISHER (
PUBLISHERID VARCHAR(20) NOT NULL,
PUBNAME VARCHAR(50),
ADDRESS VARCHAR(200),
CONSTRAINT PUBLISHERPK 
PRIMARY KEY (PUBLISHERID))
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_BRANCH (
LIBID VARCHAR(20) NOT NULL,
LNAME VARCHAR(50),
LLOCATION VARCHAR(200),
CONSTRAINT BRANCHPK
PRIMARY KEY (LIBID))
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_READER (
READERID VARCHAR(20) NOT NULL,
RTYPE VARCHAR(20),
RNAME VARCHAR(50) NOT NULL,
ADDRESS VARCHAR(200),
CONSTRAINT READERPK
PRIMARY KEY (READERID))
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_DOCUMENT (
DOCID VARCHAR(20) NOT NULL,
TITLE VARCHAR(100) NOT NULL,
PDATE DATE,
PUBLISHERID VARCHAR(20),
CONSTRAINT DOCUMENTPK
PRIMARY KEY (DOCID),
CONSTRAINT DOCUMENTFK
FOREIGN KEY (PUBLISHERID) REFERENCES LIBRARY_PUBLISHER(PUBLISHERID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_BOOK (
DOCID VARCHAR(20) NOT NULL,
ISBN VARCHAR(20),
CONSTRAINT BOOKPK
PRIMARY KEY (DOCID),
CONSTRAINT BOOKFK
FOREIGN KEY (DOCID) REFERENCES LIBRARY_DOCUMENT(DOCID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_WRITES (
AUTHORID VARCHAR(20) NOT NULL,
DOCID VARCHAR(20) NOT NULL,
CONSTRAINT WRITESPK
PRIMARY KEY (AUTHORID, DOCID),
CONSTRAINT WRITESFK1
FOREIGN KEY (AUTHORID) REFERENCES LIBRARY_AUTHOR(AUTHORID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT WRITESFK2
FOREIGN KEY (DOCID) REFERENCES LIBRARY_BOOK(DOCID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_PROCEEDINGS (
DOCID VARCHAR(20) NOT NULL,
CDATE DATE,
CLOCATION VARCHAR(200),
CEDITOR VARCHAR(50),
CONSTRAINT PROCEEDINGSPK
PRIMARY KEY (DOCID),
CONSTRAINT PROCEEDINGSFK
FOREIGN KEY (DOCID) REFERENCES LIBRARY_DOCUMENT(DOCID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_JOURNAL_VOLUME (
DOCID VARCHAR(20) NOT NULL,
JVOLUME SMALLINT,
EDITOR_ID VARCHAR(20),
CONSTRAINT JOURNAL_VOLUMEPK
PRIMARY KEY (DOCID),
CONSTRAINT JOURNAL_VOLUMEFK1
FOREIGN KEY (DOCID) REFERENCES LIBRARY_DOCUMENT(DOCID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT JOURNAL_VOLUMEFK2
FOREIGN KEY (EDITOR_ID) REFERENCES LIBRARY_CHIEF_EDITOR(EDITOR_ID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_JOURNAL_ISSUE (
DOCID VARCHAR(20) NOT NULL,
ISSUE_NO SMALLINT NOT NULL,
SCOPE VARCHAR(50),
CONSTRAINT JOURNAL_ISSUEPK
PRIMARY KEY (DOCID, ISSUE_NO),
CONSTRAINT JOURNAL_ISSUEFK
FOREIGN KEY (DOCID) REFERENCES LIBRARY_JOURNAL_VOLUME(DOCID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_INV_EDITOR (
DOCID VARCHAR(20) NOT NULL,
ISSUE_NO SMALLINT NOT NULL,
IENAME VARCHAR(50) NOT NULL,
CONSTRAINT INV_EDITORPK
PRIMARY KEY (DOCID, ISSUE_NO, IENAME),
CONSTRAINT INV_EDITORFK
FOREIGN KEY (DOCID, ISSUE_NO) REFERENCES LIBRARY_JOURNAL_ISSUE(DOCID, ISSUE_NO) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_COPY (
DOCID VARCHAR(20) NOT NULL,
COPYNO SMALLINT NOT NULL,
LIBID VARCHAR(20) NOT NULL,
POSITION VARCHAR(200),
CONSTRAINT COPYPK
PRIMARY KEY (DOCID, COPYNO, LIBID),
CONSTRAINT COPYFK1
FOREIGN KEY (DOCID) REFERENCES LIBRARY_DOCUMENT(DOCID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT COPYFK2
FOREIGN KEY (LIBID) REFERENCES LIBRARY_BRANCH(LIBID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_RESERVES (
RESUMBER INTEGER NOT NULL,
READERID VARCHAR(20),
DOCID VARCHAR(20),
COPYNO SMALLINT,
LIBID VARCHAR(20),
DTIME DATE,
CONSTRAINT RESERVESPK
PRIMARY KEY (RESUMBER),
CONSTRAINT RESERVESFK1
FOREIGN KEY (READERID) REFERENCES LIBRARY_READER(READERID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT RESERVESFK2
FOREIGN KEY (DOCID, COPYNO, LIBID) REFERENCES LIBRARY_COPY(DOCID, COPYNO, LIBID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE LIBRARY_BORROWS (
BORNUMBER INTEGER NOT NULL,
READERID VARCHAR(20),
DOCID VARCHAR(20),
COPYNO SMALLINT,
LIBID VARCHAR(20),
BDTIME DATE,
RDTIME DATE,
CONSTRAINT BORROWSPK
PRIMARY KEY (BORNUMBER),
CONSTRAINT BORROWSFK1
FOREIGN KEY (READERID) REFERENCES LIBRARY_READER(READERID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT BORROWSFK2
FOREIGN KEY (DOCID, COPYNO, LIBID) REFERENCES LIBRARY_COPY(DOCID, COPYNO, LIBID) ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;