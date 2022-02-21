#1b) Produce a class roster for a *specified section* sorted by student's last name, first name. 
# At the end, include the average grade (GPA for the class.)
SELECT se.SectionID, CONCAT(st.lName,', ',st.fName) as name, 
sd.LetterGrade 
FROM tp_Student as st, tp_Section_details as sd, gpa_chart as gpa, 
tp_Section as seWHERE sd.sid = st.sid 
AND sd.SectionID = se.SectionID 
AND sd.LetterGrade=gpa.LetterGradeAND se.SectionID = 3 
UNION 
SELECT se.SectionID, "Average Grade", AVG(gpa.GradePoints)
FROM tp_Student as st, tp_Section_details as sd, gpa_chart as gpa, 
tp_Section as seWHERE sd.sid = st.sid 
AND sd.SectionID = se.SectionID 
AND sd.LetterGrade=gpa.LetterGradeAND se.SectionID = 3; 

#2a) Produce a list of rooms that are equipped with *some feature* -e.g. "wired instructor station".
SELECT r.RoomID 
FROM tp_Room as r, tp_RoomFeature as rf 
WHERE r.RoomID = rf.RoomID 
AND rf.Feature LIKE 'podium'; 

#3b) Produce a list of faculty who have never taught a *specified course*.
SELECT f.FacultyID, CONCAT(f.fName, " ",f.lName) AS name 
FROM tp_Faculty as f 
WHERE NOT EXISTS (
	SELECT * 
	FROM tp_Section as se, tp_Course as cWHERE se.SectionID = f.SectionID 
	AND se.CourseNumber = c.CourseNumber 
	AND c.CourseNumber LIKE "COMP-S 101" 

); 

#5a) Produce a chronological list (transcript-like) of all courses taken by a *specified student*. Show grades earned.
SELECT c.title, sd.LetterGrade 
FROM tp_Student as st, tp_Section_details as sd, tp_Section as s, 
tp_Semester as sem, tp_Course as cWHERE st.sid = sd.sid 
AND s.SectionID = sd.SectionID 
AND sem.SemesterID = s.SemesterID 
AND c.CourseNumber = s.CourseNumber 
AND st.sid = 2 
ORDER BY sem.Term ASC; 

#7a) Produce an alphabetical list of students with their majors who are advised by a *specified advisor*.
SELECT CONCAT(st.fName,' ', st.lName) as name, m.titleFROM tp_Student as st, tp_Major as m, tp_Advisor as a, tp_Student_Major as 
sm 
WHERE a.AdvisorID = st.AdvisorID 
AND st.sid = sm.sid 
AND m.MajorID = sm.MajorIDAND a.AdvisorID = 1 
GROUP BY name 
ORDER BY name ASC; 

#9c) Produce a list of students with hours earned and overall GPA who have met the graduation requirements for any major. 
# Sort by major and then by student.

SELECT CONCAT(st.fName, ' ' , st.lName) as name, m.Title as Major, 
SUM(c.CreditHr) as hours_earned, ( SUM(gpa.GradePoints* c.CreditHr)/ 
SUM(c.CreditHr)) as Overall_GPA 
FROM tp_Student as st, tp_Major as m, tp_Course as c, gpa_chart as gpa, 
tp_Student_Major as sm, tp_Section_details as sd, tp_Section as secWHERE st.sid = sm.sid 
AND m.MajorID = sm.MajorIDAND st.sid = sd.sid 
AND c.CourseNumber = sec.CourseNumber 
AND sec.SectionID = sd.SectionID 
AND sd.LetterGrade=gpa.LetterGradeGROUP BY Major, name, m.Required_Credit_Hours, m.RequiredGPAHAVING SUM(c.CreditHr) >= m.Required_Credit_HoursAND Overall_GPA >= m.RequiredGPA; 

#Additional Queries 

#1)
# Displays name of faculty that work in rooms with > 300 capacity with RoomID and Building name 

SELECT CONCAT(f.fName, ' ', f.lName) as Name, r.Capacity, r.RoomID, b.Name 
AS "Building Name"
FROM tp_Faculty as f, tp_Room as r, tp_Building as b 
WHERE b.BuildingID = r.BuildingIDAND r.RoomID = f.RoomID 
AND r.Capacity > 300; 

#2)
# Displays students with last name starting with 'D', their advisor and adv's expertise 

SELECT st.sid as StudentID, CONCAT(st.fName, ' ' ,st.lName) as Student, 
CONCAT(a.fName, ' ' ,a.lName) as Advisor, aex.Expertise as ExpertiseFROM tp_Advisor as a, tp_Advisor_expertise as aex, tp_Student as stWHERE st.AdvisorID = a.AdvisorID 
AND a.AdvisorID = aex.AdvisorID 
AND st.lName LIKE 'D%' 
ORDER BY st.sid; 


