
val akkaVersion = "2.6.14"
val akkaHttpVersion = "10.2.4"

lazy val root = project.in(file("."))
  .enablePlugins(UniversalPlugin)
  .enablePlugins(AshScriptPlugin)
  .enablePlugins(DockerPlugin)
  .settings(
    javacOptions ++= Seq("-source", "16"),
    packageName in Docker := "retask09",
    version in Docker := "1.0.2",
    dockerBaseImage := "openjdk:16-jdk",
    dockerExposedPorts := Seq(8080),
    dockerUsername := Some("ivoya"),
    dockerUpdateLatest := true,
    normalizedName := "retask09",
    libraryDependencies ++= Seq(
      "org.fomkin" %% "korolev-http" % "1.1.0",
      "com.typesafe.akka" %% "akka-actor" % akkaVersion,
      "com.typesafe.akka" %% "akka-stream" % akkaVersion,
      "com.typesafe.akka" %% "akka-http" % akkaHttpVersion,
      "org.typelevel" %% "cats-effect" % "2.5.1",
      "org.fomkin" %% "korolev-akka" % "1.1.0",
    )
  )
