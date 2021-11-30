package client

import akka.actor.ActorSystem
import akka.http.scaladsl.Http
import akka.http.scaladsl.model.{HttpRequest => AkkaHttpRequest, HttpResponse => AkkaHttpResponse}
import korolev._
import korolev.akka._
import korolev.server._
import korolev.state.javaSerialization._

import scala.concurrent.ExecutionContext.Implicits.global
import scala.concurrent.Future
import scala.concurrent.duration.{FiniteDuration, SECONDS}

class KorolevClient(implicit actorSystem: ActorSystem) {

  val applicationContext = Context[Future, State, Any]

  import applicationContext._
  import levsha.dsl._
  import html.{Html, body, button}

  private val config = KorolevServiceConfig[Future, State, Any](
    stateLoader = StateLoader.default(State("RETask09", "")),
    document = s => optimize {
      Html(
        body(
          s"${s.i}. Server time: ${s.time}",
          button("Click me!",
            event("click") { access =>
              sendTimeRequest(s.i).flatMap { newS =>
                access.eventData.flatMap(_ => access.transition { s =>
                  s.copy(time = newS.time)
                })
              }
            }
          )
        )
      )
    }
  )

  private def sendTimeRequest(message: String): Future[State] = {
    val responseFuture: Future[AkkaHttpResponse] = Http().singleRequest(AkkaHttpRequest(uri = "http://localhost:8081"))

    responseFuture
      .flatMap {res =>
        res.entity.toStrict(FiniteDuration(3, SECONDS)).map(_.data.utf8String)
      }.map(State(message, _))
  }

  val route = akkaHttpService(config).apply(AkkaHttpServerConfig())
}

case class State(i: String, time: String)