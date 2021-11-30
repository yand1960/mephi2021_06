name := "RETask09"

scalaVersion := "2.13.6"

addCompilerPlugin("org.typelevel" % "kind-projector" % "0.13.2" cross CrossVersion.full)

val akkaVersion = "2.6.14"
val akkaHttpVersion = "10.2.4"

libraryDependencies ++= Seq(
  "org.fomkin" %% "korolev-http" % "1.1.0",
  "com.typesafe.akka" %% "akka-actor" % akkaVersion,
  "com.typesafe.akka" %% "akka-stream" % akkaVersion,
  "com.typesafe.akka" %% "akka-http" % akkaHttpVersion,
  "org.typelevel" %% "cats-effect" % "2.5.1",
  "org.fomkin" %% "korolev-akka" % "1.1.0",
)
