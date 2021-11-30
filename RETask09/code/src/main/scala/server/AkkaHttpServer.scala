package server

import akka.http.scaladsl.model._
import akka.http.scaladsl.server.Directives._

import java.util.Calendar

object AkkaHttpServer {
  val server = AkkaHttpServer

  val route =
    path("") {
      get {
        complete(HttpEntity(ContentTypes.`text/plain(UTF-8)`, s"${Calendar.getInstance().getTime}"))
      }
    }
}
