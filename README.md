=== DESCRIPTION === 
  This is a library/portal for an auto maintenance shop that handles different kinds of vehicles (diesel, gas or electric) and records various maintenance tasks that can be done (oil change, battery change etc). Some asks may be common across all types (e.g. tire rotation) but others may not be (e.g. oil change vs power battery change). So OOP concepts are employed to streamline different scenarios and situations.

=== LIBRARY ===
  The library is written in object oriented PHP (5.6) and leverages OOP concepts like inheritance, polymorphism and encapsulation. The classes with the directories 'Domain' and 'Repository' primarily belong to the library and are all interlinked within the inheritance hierarchy. 

  The library primarily exercises the Repository pattern where domain objects are separated from the execution (operations like CRUD; represented as 'Services') and hence only the objects responsible for 'public-facing' are exposed to view. Through polymorphic behavior and inheritance, they implement the domain classes'  behaviors without the view knowing about it.

  To portray the impression of persistent storage, I am using sessions. A given service class would have some back-and-forth between session and normal array but that's only to make sure that end-user feels a presence of persistent storage. If DB is introduced to the library, this can be easily modified. 

  I'm using arrays and in that, their key indices as IDs for a given record (a vehicle). For now due to simple nature of project, I didn't deem fit to have an overkill with methods using dependency injection; so simple IDs are passed wherever necessary/appropriate. If the project has a bit more defined scope, there should be a possibility to introduce DI.

=== VIEW ===
  The view in this work is primarily included to demonstrate the working of the library. Hence, if there's a situation where this library is turned into a full project, an MVC framework is recommended to handle front controller; a streamlined JS mechanism should also be considered then. View related aspects like validation etc shouldn't be expected.

  There's one file that primarily connects view with the services' classes; that's being used by both view files to communicate with server. That file can be further refined of course but for now, it manages to invoke required classes without the classic if-else/switch and different new services (i.e. new types of vehicles, for example) can be added with the same length of code in this file. 

=== TESTS ===
  I have given tests for two classes: one is the main abstract class which is indirectly referred to by all services and hence is ubiquitous in spirit across the library, and other is one of the services' class. Since services' classes are quite similar in their attitude, if sought, similar tests can be written for the rest of them. The tests will have to be modified if DB storage is introduced. The tests I attempted are based on how they 'should' be written (didn't have access to PHPUnit). If there's any error in tests, kindly keep this in mind.
