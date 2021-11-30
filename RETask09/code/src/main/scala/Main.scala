import akka.actor.ActorSystem
import akka.http.scaladsl.Http
import client.KorolevClient
import server.AkkaHttpServer.server

object Main extends App {
  private implicit val actorSystem: ActorSystem = ActorSystem()

  val client = new KorolevClient()

  Http().newServerAt("0.0.0.0", 8081).bindFlow(server.route)

  Http().newServerAt("0.0.0.0", 8080).bindFlow(client.route)

}
