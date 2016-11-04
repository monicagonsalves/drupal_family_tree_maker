# GedcomRecord
---
GedcomRecords have a hierarchal structure. Therefore, we represent a single GedcomRecord as a tree. To create GedcomRecord, we take as input a GedcomLineSublist that represents a logical record. A GedcomLineSublist represents a logical record if it contains exactly one line with a level of 0. We then determine the hierarchal structure of the GedcomLineSublist using the following rules: 

For each of the following rules, let l1 and l2 represent lines and l1 appears before l2 in the list. Furthermore, let l1.level represent the level of l1 and l2.level represent the level of l2. Assume we are processing l2, and the parents of all previous lines have been set. 

+ If l1.level < l2.level, then l1 is the parent of l2. 
   - Set l2.parent = l1.
   - Add l2 to l1.children. 
+ If l1.level == l2.level, then l1 and l2 are siblings. 
   - Set l2.parent to l1.parent.
   - Add l2 to (l1.parent).children
     + This assumes l1.parent is always set before l2.parent. 
+ If l1.level > l2.level, then l2 is the sibling of the parent of l1. 
   - Set l2.parent to l1.parent.parent 
   - Add l2 to (l1.parent.parent).children  